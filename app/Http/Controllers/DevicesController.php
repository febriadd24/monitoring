<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\devices;
use App\manifest;
use DB;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
                'UID'=>'required',
            'PCID'=>'required',
            'CONFIG'=>'required',
            'RFID' => 'required',
            'FP' => 'required',
            'Status'=>'required',
            'ipAddress'=>'required',
            ]);

            $UID=$request->input('UID');
            $PCID=$request->input('PCID');
            $CONFIG=$request->input('CONFIG');
            $RFID=$request->input('RFID');
            $FP=$request->input('FP');
            $Status=$request->input('Status');
            $ipAddress=$request->input('ipAddress');

$manifests =new manifest([
    'UID'=>$UID,
    'PCID'=>$PCID,
    'CONFIG'=>$CONFIG,

]);
if ($manifests ->save()){
    $manifests->view_manifests = [

        'href'=>'api/v1/device/'.$manifests->UID,
        'method' => 'POST'
    ];

    $model =new devices([
        'UID'=>$UID,
        'RFID'=>$RFID,
        'FP'=>$FP,
        'Status'=>$Status,
        'ipAddress'=>($ipAddress),

    ]);
    if ($model ->save()){
        $model->view_devices = [

            'href'=>'api/v1/device/'.$model->UID,
            'method' => 'POST'
        ];

    $message=[
        'msg' =>'Devices & manifest Ditambahkan ',
        'data1' => $model,
        'data2' => $manifests,
        ];
        return response() ->json($message,200);
    }
}}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manifests = devices::where('UID', '=', $id)->firstorFail();
        $manifests->view_manifests = [
        'href'=>'api/v1/Device/'.$manifests->id,
    'method'=>'GET'
        ];

        $response =$manifests;
return response()->json($response,200);
    }

    public function showIP($id)
    {
        // $getIP = devices::where('ipAddress', '=', $id)->firstorFail();
        // // $getIP=DB::table('Devices')->where('ipAddress', $id)->pluck('UID');   
        // $getIP->view_getIP = [
        // 'href'=>'api/v1/showIP/'.$getIP->id,
        // 'method'=>'POST'
        // ];

        // $response =$getIP;
        // return response()->json($response,200);
    
        $DeviceIP = devices::where('ipAddress', '=', $id)->firstorFail();
        $DeviceIP->view_DeviceIP = $DeviceIP->id;

        $response =$DeviceIP->ipAddress;
       return response()->json($response,200);
    
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function updatestatus(Request $request, $id)
    {
        $this->validate($request,[
            'RFID' => 'required',
            'FP' => 'required',
        ]);
        $RFID = $request->RFID;
        $FP = $request->FP;
        $UID = $request->UID;
        $Status = $request->Status;
        $model= devices::where('ipAddress', '=', $id)->firstorFail();
        $model->RFID=$RFID;
        $model->FP=$FP;
        $model->UID=$UID;
        $model->Status=$Status;
        $model->save();
        $response =[
            'msg'=>'Update Device Status',
            'Data'=> $model
        ];
return response()->json($response,200);
    }
}

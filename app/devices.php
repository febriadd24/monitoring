<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class devices extends Model
{
    protected $fillable = [
        'id','UID', 'RFID', 'FP','Status','updated_at','ipAddress'
     ];
}

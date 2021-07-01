@extends('app')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Daftar Abaka

            </h3>
        </div>
        <div class="panel-body">
            <table id="datatable" class="table table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>UID</th>
                    <th>Card Reader</th>
                    <th>Finger Print</th>
                    <th>Status</th>
                    <th>updated_at</th>

                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>UID</th>
                    <th>Card Reader</th>
                    <th>Finger Print</th>
                    <th>Status</th>
                    <th>updated_at</th>

                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#datatable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            ajax: '{{ url("/table/monitoring") }}',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'UID', name: 'UID'},
                {data: 'RFID', name: 'RFID'},
                {data: 'FP', name: 'FP'},
                {data: 'Status', name: 'Status'},
                {data: 'updated_at', name: 'updated_at'},
            ]

        });
    </script>
@endpush

@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="col">
            <div class="row-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary btn-sm"> Add new person</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="personTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addStyle')
    <link rel="stylesheet" href="{{asset('vendor/DataTables/datatables.min.css')}}">
@endsection

@section('addScript')
    <script src="{{asset('vendor/DataTables/datatables.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
      var table = $('#personTable').DataTable({
            responsive:true,
          processing: true,
          serverSide: true,
          ajax: "{{ route('person.pegawaiData') }}",
          columns: [
              {data: 'DT_RowIndex',name:'DT_RowIndex',orderable: false, searchable: false},
              {data: 'name'},
              {data: 'nip'},
              {data: 'action', orderable: false, searchable: false},

          ]
  
      });
  
      
  
    });
    </script>
@endsection
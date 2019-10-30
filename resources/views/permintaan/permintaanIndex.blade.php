@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                          <a class="nav-link active" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                      </ul>
                </div>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="permintaanTable">
                            <thead>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Jenis Pengadaan</th>
                                <th>Subject Matter</th>
                                <th>Kode Kegiatan</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
           
        </div>
    </div>
@endsection

@section('addStyle')
    <style>
    #permintaanTable{
      font-size:0.8rem;
    }
    </style>
@endsection

@section('addScript')
    <script>
    $(document).ready(function(){
      
    $(function () {
      var table = $('#permintaanTable').DataTable({
          responsive:true,
          processing: true,
          serverSide: true,
          ajax: "{{ route('permintaan.permintaanData') }}",
          columns: [
              {data: 'DT_RowIndex',name:'DT_RowIndex',orderable: false, searchable: false},
              {data: 'judul_'},
              {data: 'jenis_pengadaan'},
              {data: 'nama'},
              {data: 'kode_kegiatan'},
              {data: 'harga'},
              {data: 'status'},
              {data: 'action', orderable: false, searchable: false},

          ]
  
      });
  
      
  
    });
    })
    
    </script>
@endsection
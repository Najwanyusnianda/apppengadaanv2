@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                              <a class="nav-link {{Request::is('inbox/disposisi') ? 'active' : ''}}" href="{{route('box.inboxIndex')}}">Pesan Disposisi Masuk</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{Request::is('sent/disposisi') ? 'active' : ''}}" href="{{route('box.sentIndex')}}">Pesan Disposisi Terkirim</a>
                            </li>
                          </ul>
            </div>
            <div class="card-body">
                <div class="message_box">
                  <div class="table-responsive">
                    <table class="table" id="inboxTable">
                      <thead>
                        <td>No.</td>
                        <th>Pengirim</th>
                        <th>Konten</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addScript')
    <script>
    $(document).ready(function(){
      //load table
      $('#inboxTable').DataTable({
          responsive:true,
          processing: true,
          serverSide: true,
          ajax: "/data/inbox",
          columns: [
              {data: 'DT_RowIndex',name:'DT_RowIndex', searchable: false},
              {data: 'pengirim'},
              {data: 'konten'},
              {data: 'created'},
          

          ]
  
      });
    })
    
    </script>
@endsection
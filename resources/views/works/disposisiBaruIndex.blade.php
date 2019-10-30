@extends('layouts.master')

@section('content')
    <div class="container">
      <div class="col">
        <div class="row-md-8">
          <div class="card">
            <div class="col mt-2 mb-2">
                <button class="btn btn-sm btn-secondary p-2" id="showWorkLoad">Show WorkLoad</button>
            </div>
          
          </div>
        </div>
      </div>
      <div class="row-md-8">
          <div class="card">
              <div class="card-header">
                
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table class="table" id="permintaanBaruTable">
                          <thead>
                              <tr>
                                      <th>Agno</th>
                                      <th>Judul</th>
                                      <th>Jenis Pengadaan</th>
                                      <th>Subject Matter</th>
                                      <th>Kode Kegiatan</th>
                                      <th>Nilai</th>
                                      <th>Status</th>
                                      <th>Aksi</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
          </div>
      </div>

    </div>


    <!--- modal -->

    <!-- Modal -->
<div class="modal fade" id="disposisiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-body" id="disposisiBody">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="sendDisposisiButton">Kirim Disposisi</button>
        </div>
      </div>
    </div>
  </div>

  @include('modalComponent.modalLgDefault',['modal_id'=>'stafWorkloadModal','modal_body_id'=>'workloadBody'])
@endsection

@section('addStyle')
  <style>
      #permintaanBaruTable{
      font-size:0.8rem;
    }
  </style>  
@endsection

@section('addScript')
<script>

        $(document).ready(function(){

          function post_disposisi_baru(disposisiData) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }


              });

              $.ajax({
                  type: 'POST',
                  url:'/disposisi/store' ,
                  data: disposisiData,
                  success: function (data) {
                    console.log(data)
                        Swal.fire(
                        'Terkirim!',
                        'Disposisi Terkirim',
                        'success'
                      )
                      $('#disposisiModal').modal('hide');
                      $('#permintaanBaruTable').DataTable().ajax.reload();
                  },


              });


          }
          //ajax table
        $(function () {
          var table = $('#permintaanBaruTable').DataTable({
              responsive:true,
              processing: true,
              serverSide: true,
              ajax: "{{ route('works.disposisiBaruData') }}",
              columns: [
                  //{data: 'DT_RowIndex',name:'DT_RowIndex',orderable: false, searchable: false},
                  {data: 'id'},
                  {data: 'judul_'},
                  {data: 'jenis_pengadaan'},
                  {data: 'nama_bagian'},
                  {data: 'kode_kegiatan'},
                  {data: 'harga'},
                  {data: 'status'},
                  {data: 'action', orderable: false, searchable: false},
    
              ]
      
          });
      
          
      
        });


        $('body').on('click','.disposisi-button',function(evt){
            evt.preventDefault();
            var modal=$('#disposisiModal');
            var url=$(this).attr('href');

            $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                $('#disposisiBody').html(response);
                
              
                var disposisiForm=$('#disposisiForm').serialize();
                //console.log(updateForm);
                
                }
            });
            modal.modal('show')
        })

        $('#sendDisposisiButton').click(function(event){
          event.preventDefault();
     
          var disposisi_data=$('#buatDisposisiForm').serialize();
          
          post_disposisi_baru(disposisi_data)


        })
        })   
</script>



<script>
  $(document).ready(function(){
    var showWorkLoadBtn=$("#showWorkLoad");
    var url="/works/workload"

    showWorkLoadBtn.click(function(evt){
      evt.preventDefault();
      $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                $('#workloadBody').html(response);
                      
                //console.log(updateForm);
                
                }
              });
      $('#stafWorkloadModal').modal('show')
    })


  })
</script>

<script>

</script>
@endsection
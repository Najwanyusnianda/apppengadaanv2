<div class="col">
    <div class="row-md-8">
        <div class="col">
            <strong>Filter By:</strong>
        </div>
    </div>
    <hr>
    <div class="row-md-8">
        <div class="table-responsive">
            <table class="table" id="staffTable">
                <thead>
                    <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th class="text-center">Permintaan</th>
                            <th>Aksi</th>
                    </tr>

                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    


</style>

<script>
$(document).ready(function(){

    //load tabel staffWorkload
    $(function () {
          var table = $('#staffTable').DataTable({
              responsive:true,
              processing: true,
              serverSide: true,
              searching: false, 
              paging: false,
              ajax: "{{ route('works.workLoad') }}",
              columns: [
                  //{data: 'DT_RowIndex',name:'DT_RowIndex',orderable: false, searchable: false},
                  {data: 'name'},
                  {data: 'nip'},
                  {data: 'count',className: 'text-center'},
                  {data: 'action', orderable: false, searchable: false},
    
              ]
      
          });
      
          
      
    });
})
</script>



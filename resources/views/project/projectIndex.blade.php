@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="col">
            <div class="row-12">
                <div class="card">
                    <div class="card-header">
                        
                        <a href="#" class="btn btn-primary" id="addProject"><i class="fas fa-folder-plus fa-lg"></i> Add New Project
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-condensed" id="projectTable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Project Name</th>
                                        <th>Description</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>

    </div>


<!-- modal -->
<div class="modal fade" id="addProjectModal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                    <strong> Add New Project</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('project._addProjectForm')
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="settingProjectModal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                        <strong> </strong>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('project._settingProject')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
@endsection

@section('addStyle')
    <link rel="stylesheet" href="{{asset('vendor/DataTables/datatables.min.css')}}">
@endsection

@section('addScript')

<script src="{{asset('vendor/DataTables/datatables.min.js')}}"></script>

<script type="text/javascript">

    $(function () {
      var table = $('#projectTable').DataTable({
            responsive:true,
          processing: true,
          serverSide: true,
          ajax: "{{ route('project.projectData') }}",
          columns: [
              {data: 'DT_RowIndex',name:'DT_RowIndex',orderable: false, searchable: false},
              {data: 'name'},
              {data: 'description'},
              {data: 'action', orderable: false, searchable: false},

          ]
  
      });
  
      
  
    });
  
  </script>

<!-- modal script -->
  <script type="text/javascript">
  var addProjectButton =$('#addProject');
  var addProjectModal= $("#addProjectModal");
  var settingProjectModal= $("#settingProjectModal");

  addProjectButton.click(function(event){
    event.preventDefault();
    addProjectModal.modal("show");
    
  })


  //project settiing
  $(function(){
      $('body').on('click','.setting-project-button',function(event){
          event.preventDefault();
          settingProjectModal.modal("show");
      })
  })
  </script>
@endsection
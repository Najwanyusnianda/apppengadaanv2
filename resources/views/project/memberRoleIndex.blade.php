@extends('layouts.master')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{route('project.index')}}">Project</a></li>
        <li class="breadcrumb-item"><a href="#">Project {{$project_name}}</a></li>
        <li class="breadcrumb-item active">Member</li>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card ">
                    <div class="card-header ">
                            <div class="row">
                                <div class="col">
                                        <h3><strong>{{$project_name}}</strong></h3>
                                </div>
                                <div class="col">
                                        <div class="btn-group float-right">

                                                <button class="btn  btn-primary" id="show_modal_button" project-id="{{$project_id}}"  > <i class="fas fa-plus"></i><strong style="font-size:0.8rem"> Tambah </strong> </button>
                                                @if ($active_status==1)
                                                    <button disabled="disabled" class="ml-2 btn btn-success">Currently Active</button>
                                                @else
                                                <button type="button" class="ml-2 btn btn-secondary" id="active-project-button"><strong style="font-size:0.8rem">Aktifkan Project</strong> </button>        
                                    
                                                @endif
                                        </div>
                                </div>

                            </div>

                    </div>
                    <div class="card-body">

                            <div class="table-responsive">
                                <table class="table" id="memberTable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>nip</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                    </div>
                    <div class="card-footer">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
<div class="modal fade" id="addPersonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="select-person-modal-body" >

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success" id="add_person">Tambah</button>
        </div>
      </div>
    </div>
  </div>


<!--modal user config -->
<div class="modal fade " id="configModal"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container" id="config-modal-body">

              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="updateMemberData">Update Data</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
@endsection


@section('addStyle')
<style>
        .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #28a745;
        }

        .custom-control.custom-checkbox {
            padding-left: 0;
        }

        label.custom-control-label {
            position: relative;
            padding-right: 1.5rem;
        }

        label.custom-control-label::before,
        label.custom-control-label::after {
            right: 0;
            left: auto;
        }

        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 500
        }

        </style><style>.select2-container--default {
            width: 100% !important;
        }
</style>

<style>

</style>
@endsection


@section('addScript')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>


var memberTable = $('#memberTable').DataTable({
    responsive:true,
    processing: true,
    serverSide: true,
    ajax: "{{ route('project.member.data',[$project_id]) }}",
    columns: [
        {data: 'name'},
        {data: 'nip'},
        {data: 'role'},
        {data: 'action', orderable: false, searchable: false},

    ]
  
});

</script>
<script type="text/javascript">
$(document).ready(function(){
        


    function add_member_to_project(member_choose_id) {


        var project_id=addPersonModal.attr('project-id');
        console.log(project_id);
        var store_member_url = "{{route('project.member.store',[$project_id])}}"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }


        });

        $.ajax({
            type: 'POST',
            url: store_member_url,
            data: {
                members_id: member_choose_id
            },
            success: function (data) {
                $('#memberTable').DataTable().ajax.reload();
            },
         

        });
    }




    var show_modal_button = $('#show_modal_button')
    var addButton = $('#add_person');
    var addPersonModal = $('#addPersonModal');
    var personSelect = $('#person-select');



    show_modal_button.click(function () {
        var url="{{route('project.member.selectMember',[$project_id])}}"
        $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                $('#select-person-modal-body').html(response);
                
              
                updateForm=$('#updatePersonForm').serialize();
                //console.log(updateForm);
                
                }
        });
        addPersonModal.modal('show');
    })

    addButton.click(function (event) {
        //var personName = personSelect.find('option:selected').text();
       // var personId = personSelect.find('option:selected').val();
        var selectPerson = $('#person-select');
        var members_id=selectPerson.val();
            console.log(members_id);
        //ajax post
        add_member_to_project(members_id);
 

        addPersonModal.modal('hide');
    })



})
</script>


<script>

///update member role    
var configModal=$('#configModal');
var updateForm;
function update_member_data(serialize_data){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }


        });

        $.ajax({
            type: 'POST',
            url: "{{route('project.member.role.update',[$project_id])}}",
            data: serialize_data,
            success: function (data) {
                $('#memberTable').DataTable().ajax.reload();
            },
         

        });
    }

$("body").on('click','.configMember',function(event){
    event.preventDefault();
    var me=$(this);
    var url= me.attr('href');
    
    configModal.modal('show');
    $.ajax({
                url: url,
                dataType: 'html',
                success: function(response) {
                $('#config-modal-body').html(response);
                
              
                updateForm=$('#updatePersonForm').serialize();
                //updateForm=$('#updatePersonForm').serializeArray();
                console.log(updateForm);
                
                }
        });
        
})

$("select[name='person_role']").change(function(){
    
})

$('#updateMemberData').click(function(event){
    update_member_data($('#updatePersonForm').serialize())
    configModal.modal('hide');
})

///aktifkan project

var activeButton=$('#active-project-button');

activeButton.click(function(evt){
    evt.preventDefault();
    var url = "{{route('project.active')}}"
    Swal.fire({
            title: '',
            text: "Aktifkan Project?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        })
        .then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        project_id: "{{$project_id}}"
                    },
                    success: function (response) {
                        activeButton.hide();
                        Swal.fire(
                            'Project Telah di Aktifkan'
                        );
                    }
                });
            }}
            )
})




</script>


@endsection
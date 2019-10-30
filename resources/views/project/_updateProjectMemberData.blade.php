<form id="updatePersonForm">
                <input type="text" class="form-control" name="user_id" hidden  value="{{$person_detail->user_id}}">  
   <!-- <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" name="person_name" placeholder="Input Nama" value="{{$person_detail->name}}">
    </div>
    <div class="form-group">
            <label for="exampleInputEmail1">NIP</label>
            <input type="text" class="form-control" name="person_nip" placeholder="Nomor Induk Pegawai" value="{{$person_detail->nip}}">
    </div>
    <hr>
    <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control" name="person_username" placeholder="Input Username" value="{{$person_detail->username}}">
    </div>

    <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="person_email" placeholder="Input Email" value="{{$person_detail->email}}">
    </div>-->

    <div class="table-responsive">
            <table class="table table-borderless">
                <tr>
                        <th> Nama</th>
                        <td>:</td>
                        <td>{{$person_detail->name}}</td>
                </tr>
                <tr>
                        <th>NIP</th>
                        <td>:</td>
                        <td>{{$person_detail->nip}}</td>
                </tr>
                <tr>
                                <th>Username</th>
                                <td>:</td>
                                <td>{{$person_detail->username}}</td>   
                </tr>
                <tr>
                                <th>Email</th>
                                <td>:</td>
                                <td>{{$person_detail->email}}</td>
                </tr>
                <tr>
                        <th>Role</th>
                        <td>:</td>
                        <td>    
                                <div class="form-group">
                                        <select class="form-control" name="person_role">
                                                <option value="3">Staf ULP</option>
                                                <option value="1">Kepala ULP</option>
                                                <option value="2">Kasie ULP</option>
                                        </select>
                                </div>
                        </td>
                </tr>
                

            </table>
    </div>

</form>

<script>
$("select[name='person_role']").change(function(){
        console.log($(this).val())
})
</script>
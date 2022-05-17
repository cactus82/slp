@extends('layouts.master')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Senarai Pengguna Sistem</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/pengguna">Pengguna</a></li>
                        <li class="breadcrumb-item active">Senarai Pengguna</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="m-0">Pengguna Sistem</h5>
                                </div>
                                <div class="col-6">
                                    <button id="btnTambah" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-new-user"><i
                                            class="fas fa-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="tablePengguna" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:35px" class="hideable">ID</th>
                                        <th>Nama Pengguna</th>
                                        <th class="hideable">No KP</th>
                                        <th class="hideable">Email</th>
                                        <th>Role</th>
                                        <th class="hideable">Tarikh Kemaskini</th>
                                        <th style="width: 60px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="loading" class="overlay"><i class="fas fa-sync-alt fa-spin"></i></div>
                        <div class="card-footer">
                            ...
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- MODAL NEW USER -->
<div class="modal fade in" id="modal-new-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pengguna Baru</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div id="newDataError" style="display: none" class="alert alert-danger"></div>
            <form id="newUserForm" data-parsley-validate="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Penuh</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    data-parsley-error-message="<p class='text-red'>Nama penuh diperlukan!</p>"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombor Kad Pengenalan</label>
                                <input type="text" class="form-control" id="ic_number" name="ic_number"
                                    placeholder="Contoh: 840912125116 (tanpa -)"
                                    data-parsley-error-message="<p class='text-red'>Nombor Kad Pengenalan diperlukan!</p>"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email" name="email" required
                                    data-parsley-error-message="<p class='text-red'>Email diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" id="role" class="form-control"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                    <option value="" selected>Pilih</option>
                                    <option value="normal">normal</option>
                                    {{-- <option value="guest">Guest (View only)</option> --}}
                                    <option value="admin">admin</option>
                                    <option value="client">client</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" id="password" name="password" required
                                    data-parsley-error-message="<p class='text-red'>Password diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnNewUser" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT USER -->
<div class="modal fade in" id="modal-edit-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kemaskini Data Pengguna</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div id="editDataError" style="display: none" class="alert alert-danger"></div>
            <form id="editUserForm" data-parsley-validate="">
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Penuh</label>
                                <input type="text" class="form-control" id="name_edit" name="name"
                                    data-parsley-error-message="<p class='text-red'>Nama penuh diperlukan!</p>"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nombor Kad Pengenalan</label>
                                <input type="text" class="form-control" id="ic_number_edit" name="ic_number"
                                    placeholder="Contoh: 840912125116 (tanpa -)"
                                    data-parsley-error-message="<p class='text-red'>Nombor Kad Pengenalan diperlukan!</p>"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" id="email_edit" name="email" required
                                    data-parsley-error-message="<p class='text-red'>Email diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" id="role_edit" class="form-control"
                                    data-parsley-error-message="<p class='text-red'>Diperlukan!</p>" required>
                                    <option value="" selected>Pilih</option>
                                    <option value="normal">normal</option>
                                    {{-- <option value="guest">Guest (View only)</option> --}}
                                    <option value="admin">admin</option>
                                    <option value="client">client</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Reset Password (optional)</label>
                                <input type="password" class="form-control" id="password_edit" name="password"
                                    required data-parsley-error-message="<p class='text-red'>Password diperlukan!</p>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" id="btnUpdateUser" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.loading animation -->
<div class="loader" style="display:none"></div>

@push('styles')
<style>
    .loader {
        border: 10px solid #f3f3f3;
        /* Light grey */
        border-top: 10px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 2s linear infinite;
        position: absolute;
        z-index: 2000;
        left: 50%;
        top: 35%;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>
@endpush

@push('script')
<script>
    $(function(){
    //Recreate datatable
    $('#tablePengguna').DataTable({
    "order": [[0,"desc"]]
    });
    $('#loading').hide();
    fillDataTable();
});

//Populate Datatable
function fillDataTable() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Send ajax requests
    $.ajax({
        url: '/pengguna/loadUserDatatable',
        type: 'POST',
        data: {_token: $('meta[name="csrf-token"]').attr('content')},
        dataType: 'JSON',
        success: function (response) {
            addDataTableRow(response);
        }
    });
};

function addDataTableRow(response){
    //Destroy datatable and empty records
    $('#tablePengguna').DataTable().destroy();
    $("#tablePengguna tbody").empty();

    $('#loading').show();

    var curUserRole = "{{Auth::user()->role}}";

    //Append data on body
    $.each(response.result, function (i,data) {
        var editButton = '<button type="button" class="btn btn-warning btn-xs btn-flat" data-toggle="modal" data-target="#modal-edit-user" data-id="'+data.id+'"'+
         'data-name="'+data.name+'" data-email="'+data.email+'" data-role="'+data.role+'" data-ic_number="'+data.ic_number+'"><i class="fas fa-pen"></i></button>';
        var deleteButton = '<button type="button" class="btn btn-danger btn-xs btn-flat btnDeleteUser" data-id="'+data.id+'"><i class="fas fa-trash"></i></button>';

        if(curUserRole!='super admin'){
            deleteButton = '';
        }
        if(data.role=='super admin' && curUserRole=='super admin'){
            deleteButton = '';
        }else if(data.role=='super admin' && curUserRole=='admin'){
            deleteButton = '';
            editButton = '';
        }

        var btnGroup = '<div class="btn-group">'
            +editButton
            +deleteButton
            '</div>';

        //Append row to body
        $("#tablePengguna tbody").append('<tr>'
            +'<td class="hideable">'+data.id+'</td>'
            +'<td>'+data.name+'</td>'
            +'<td class="hideable">'+data.ic_number+'</td>'
            +'<td class="hideable">'+data.email+'</td>'
            +'<td>'+data.role+'</td>'
            +'<td class="hideable">'+((data.update_date) ? data.update_date : "")+'</td>'
            +'<td>'+btnGroup+'</td>'
            +'</tr>');
    });

    //Recreate datatable
    $('#tablePengguna').DataTable({
    "order": [[0,"desc"]]
    });

    $('#loading').hide();
}

$('#tablePengguna').on("click",".btnDeleteUser",function(){
    if(confirm('Adakah anda pasti untuk hapuskan pengguna ini? Klik OK untuk hapuskan sekarang')){
        var row_id = $(this).closest('.btnDeleteUser').attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //Send ajax requests
        $.ajax({
            url: '/pengguna/postDeleteUser',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                borang_id: row_id,
                },
            dataType: 'JSON',
            success: function (response) {
                addDataTableRow(response);
            }
        });
    }
});

//Save new record
$('#btnNewUser').click(function(e){
    e.preventDefault();
    $('#newUserForm').parsley().validate();

    if($('#newUserForm').parsley().isValid()){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/pengguna/postNewUser',
            type: 'POST',
            data: $('#newUserForm').serialize(),
            dataType: 'JSON',
            success: function (response) {
                if(response.status=='success'){
                    $('#newDataError').html('');
                    $('#newDataError').hide();
                    addDataTableRow(response);
                    $('#modal-new-user').modal('hide');
                }else{
                    //Add list of errors in the modal div
                    var errorHTML = '<strong>Error!</strong><ul>';
                    $.each(response.errors,function(i,data){
                         errorHTML = errorHTML+'<li>'+data[0]+'</li>';
                    });
                    errorHtml = errorHTML+'</ul>';
                    $('#newDataError').html(errorHTML);
                    $('#newDataError').show();
                }
            }
        });
    }
});

$('#btnUpdateUser').click(function(e){
    e.preventDefault();

    if("{{Auth::user()->role}}=='super admin'"){
        //remove required for role
        $('#role_edit').prop('required',false);
    }else{
        $('#role_edit').prop('required',true);
    }

    if($('#password_edit').val()==""){
        $('#password_edit').prop('required',false);
    }else{
        $('#password_edit').prop('required',true);
    }

    $('#editUserForm').parsley().validate();

    if($('#editUserForm').parsley().isValid()){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/pengguna/postUpdateUser',
            type: 'POST',
            data: $('#editUserForm').serialize(),
            dataType: 'JSON',
            success: function (response) {
                if(response.status=='success'){
                    $('#editDataError').html('');
                    $('#editDataError').hide();
                    addDataTableRow(response);
                    $('#modal-edit-user').modal('hide');
                }else{
                    //Add list of errors in the modal div
                    var errorHTML = '<strong>Error!</strong><ul>';
                    $.each(response.errors,function(i,data){
                         errorHTML = errorHTML+'<li>'+data[0]+'</li>';
                    });
                    if(response.email_error != ""){
                        errorHTML = errorHTML+'<li>'+response.email_error+'</li>';
                    }
                    if(response.ic_error != ""){
                        errorHTML = errorHTML+'<li>'+response.ic_error+'</li>';
                    }
                    errorHtml = errorHTML+'</ul>';
                    $('#editDataError').html(errorHTML);
                    $('#editDataError').show();
                }
            }
        });
    }
});

$('#btnTambah').click(function(){
    $('#editUserForm').parsley().reset();
    $('#editUserForm').trigger('reset');
    $('#editDataError').html('');
    $('#editDataError').hide();
});

$('#modal-edit-user').on('show.bs.modal',function(event){
    $('#editUserForm').parsley().reset();
    $('#editUserForm').trigger('reset');
    $('#editDataError').html('');
    $('#editDataError').hide();

    var button = $(event.relatedTarget);
    $('#user_id').val(button.data('id'));
    $('#name_edit').val(button.data('name'));
    $('#ic_number_edit').val(button.data('ic_number'));
    $('#email_edit').val(button.data('email'));

    if(button.data('role')=='super admin'){
        $('#role_edit').val("");
        $('#role_edit').prop('disabled',true);
    }else{
        $('#role_edit option:contains("' + button.data('role') + '")').attr('selected', 'selected');
        $('#role_edit').prop('disabled',false);
    }

});

</script>
@endpush
@endsection

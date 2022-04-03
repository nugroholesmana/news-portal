@extends('backend.layouts.app')

@section('content')
    @push('stylesheet')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    @endpush
    <ol class="breadcrumb">
        <li class="breadcrumb-item">admin</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             <div class="row">
                 <div class="col-lg-9">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             <a class="pull-right" href="#" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                            <div class="alert alert-success" role="alert" style="display:none"></div>
                            <div class="alert alert-danger" role="alert" style="display:none"></div>
                            <table id="table-admin" class="table table-border display">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Created At</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>        
                         </div>
                     </div>
                  </div>
             </div>
         </div>
    </div>
    <!-- Modal Add-->
    <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-username">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-password">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirmation_password">Confirmation Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="confirmation_password_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-confirmation_password">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-add">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit-->
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="username_edit" disabled>
                </div>
                <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_edit">
                    <span class="invalid-feedback" style="display:block" id="invalid-password">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="confirmation_password">Confirmation Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="confirmation_password_edit">
                    <span class="invalid-feedback" style="display:block" id="invalid-confirmation_password">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-edit">Save changes</button>
            </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="{{ url('js/helper/get-data-table.js') }}"></script>
        <script src="{{ url('js/helper/ajax-process.js') }}"></script>
        <script src="{{ url('js/helper/form-validation.js') }}"></script>
        <script type="text/javascript">
            var errors = [];
            var endpointDataList = "api/get-admin-list";
            var endpointAddData = "api/admin/add";
            var endpointEditData = "api/admin/edit";
            var endpointDeleteData = "api/admin/delete";
            var endpointGetData = "api/admin/get-data";

            $usernameAdd = $("#username_add");
            $passwordAdd = $("#password_add");
            $confirmationPasswordAdd = $("#confirmation_password_add");
            $usernameEdit = $("#username_edit");
            $passwordEdit = $("#password_edit");
            $confirmationPasswordEdit = $("#confirmation_password_edit");
            $btn = $(".btn");
            $modalAdd = $("#modal-add");
            $modalEdit = $("#modal-edit");
            
            $(document).ready(function () {
                var dataTable = getDataTables("table-admin", endpointDataList);

                $("#btn-add").click(function (e) { 
                    e.preventDefault();
                    $('.alert').hide();
                    $btn.prop('disabled', true);
                    errors = [];
                    var json = {
                        username : $usernameAdd.val(),
                        password : $passwordAdd.val()
                    };
                    errors.push(formRequired("username", $usernameAdd.val()));
                    errors.push(formRequired("password", $passwordAdd.val()));
                    errors.push(formRequired("confirmation_password", $confirmationPasswordAdd.val()));
                    errors.push(passwordMatch($passwordAdd.val(), $confirmationPasswordAdd.val()));
                    
                    if(errors.indexOf(1) == -1){
                        addData(endpointAddData, json);
                        dataTable;
                        $modalAdd.modal('toggle');
                        $btn.prop('disabled', false);
                    }else{
                        $btn.prop('disabled', false);
                    }
                });

                $(document).on('click', '.btn-modal-edit', function(e) {
                    e.preventDefault();
                    var dataID = $(this).data('id');
                    $('#btn-edit').attr("data-id", dataID);

                    var jsonData = {
                        id:dataID
                    }
                    $.ajax({
                        type: "GET",
                        url: endpointGetData,
                        data: jsonData,
                        dataType:'json',
                        success: function (response) {
                            $modalEdit.modal("show");
                            $usernameEdit.val(response.data.username);
                        }
                    });
                });

                $("#btn-edit").click(function (e) { 
                    e.preventDefault();
                    $(".alert").hide();
                    $btn.prop('disabled', true);
                    var id = $(this).attr("data-id");
                    errors = [];
                    var json = {
                        id : id,
                        password : $passwordEdit.val()
                    };

                    errors.push(formRequired("password", $passwordEdit.val()));
                    errors.push(formRequired("confirmation_password", $confirmationPasswordEdit.val()));
                    errors.push(passwordMatch($passwordEdit.val(), $confirmationPasswordEdit.val()));
                    
                    if(errors.indexOf(1) == -1){
                        updateData(endpointEditData, json);
                        $modalEdit.modal('toggle');
                        $btn.prop('disabled', false);
                    }else{
                        $btn.prop('disabled', false);
                    }
                });

                $(document).on('click', '.btn-delete', function(e) {
                    e.preventDefault();
                    if(!isConfirm) return false;
                    var id = $(this).data('id');
                    var json = {
                        id:id
                    }
                    deleteData(endpointDeleteData, json);
                    dataTable;
                });
            });
        </script>
    @endpush
@endsection


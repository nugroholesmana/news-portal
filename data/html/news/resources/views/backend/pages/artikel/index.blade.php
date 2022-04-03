@extends('backend.layouts.app')

@section('content')
    @push('stylesheet')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    @endpush
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Artikel</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="card">
                         <div class="card-header">
                             <i class="fa fa-align-justify"></i>
                             <a class="pull-right" href="#" data-toggle="modal" data-target="#modal-add"><i class="fa fa-plus-square fa-lg"></i></a>
                         </div>
                         <div class="card-body">
                            <div class="alert alert-success" role="alert" style="display:none"></div>
                            <div class="alert alert-danger" role="alert" style="display:none"></div>
                            <table id="table-artikel" class="table table-border display">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Judul Artikel</th>
                                        <th>Kategori Artikel</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Add</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul_artikel_add">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul_artikel_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-judul_artikel_add">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="kategori_artikel_add">Kategori Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="kategori_artikel_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-kategori_artikel_add">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="tag_artikel_add">Tag Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tag_artikel_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-tag_artikel_add">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="thumbnail_artikel_add">Thumbnail Artikel <span class="text-danger">*</span></label><br/>
                    <input type="file" id="thumbnail_artikel_add">
                    <span class="invalid-feedback" style="display:block" id="invalid-thumbnail_artikel_add">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="isi_artikel_add">Isi Artikel <span class="text-danger">*</span></label>
                    <textarea id="isi_artikel_add" cols="30" rows="10" class="form-control editor"></textarea>
                    <span class="invalid-feedback" style="display:block" id="invalid-isi_artikel_add">
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="judul_artikel_edit">Judul Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul_artikel_edit">
                    <span class="invalid-feedback" style="display:block" id="invalid-judul_artikel_edit">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="kategori_artikel_edit">Kategori Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="kategori_artikel_edit">
                    <span class="invalid-feedback" style="display:block" id="invalid-kategori_artikel_edit">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="tag_artikel_edit">Tag Artikel <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="tag_artikel_edit">
                    <span class="invalid-feedback" style="display:block" id="invalid-tag_artikel_edit">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="thumbnail_artikel_edit">Thumbnail Artikel <span class="text-danger">*</span></label><br/>
                    <input type="file" id="thumbnail_artikel_edit">
                    <span class="invalid-feedback" style="display:block" id="invalid-thumbnail_artikel_edit">
                        <strong class="text-invalid"></strong>
                    </span>
                </div>
                <div class="form-group">
                    <label for="isi_artikel_edit">Isi Artikel <span class="text-danger">*</span></label>
                    <textarea id="isi_artikel_edit" cols="30" rows="10" class="form-control editor"></textarea>
                    <span class="invalid-feedback" style="display:block" id="invalid-isi_artikel_edit">
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
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
        <script src="{{ url('js/helper/get-data-table.js') }}"></script>
        <script src="{{ url('js/helper/ajax-process.js') }}"></script>
        <script src="{{ url('js/helper/form-validation.js') }}"></script>
        <script type="text/javascript">
            var editorAdd;
            var editorEdit;
            var errors = [];
            var endpointDataList = "api/get-artikel-list";
            var endpointAddData = "api/artikel/add";
            var endpointEditData = "api/artikel/edit";
            var endpointDeleteData = "api/artikel/delete";
            var endpointGetData = "api/artikel/get-data";

            $judulArtikelAdd = $("#judul_artikel_add");
            $kategoriArtikelAdd = $("#kategori_artikel_add");
            $tagArtikelAdd = $("#tag_artikel_add");
            $thumbnailArtikelAdd = $("#thumbnail_artikel_add");

            $judulArtikelEdit = $("#judul_artikel_edit");
            $kategoriArtikelEdit = $("#kategori_artikel_edit");
            $tagArtikelEdit = $("#tag_artikel_edit");
            $thumbnailArtikelEdit = $("#thumbnail_artikel_edit");

            $btn = $(".btn");
            $modalAdd = $("#modal-add");
            $modalEdit = $("#modal-edit");
            
            $(document).ready(function () {
                var dataTable = getDataTables("table-artikel", endpointDataList);
                // Init CKEditor
                ClassicEditor
                .create( document.querySelector( '#isi_artikel_add' ) )
                .then( editor => {
                    editor.ui.view.editable.element.style.height = '400px';
                    editorAdd = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );

                ClassicEditor
                .create( document.querySelector( '#isi_artikel_edit' ) )
                .then( editor => {
                    editor.ui.view.editable.element.style.height = '400px';
                    editorEdit = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );

                $("#btn-add").click(function (e) { 
                    e.preventDefault();
                    $('.alert').hide();
                    $btn.prop('disabled', true);
                    errors = [];

                    var formData = new FormData();
                    
                    formData.append('judul_artikel', $judulArtikelAdd.val());
                    formData.append('kategori_artikel', $kategoriArtikelAdd.val());
                    formData.append('tag_artikel', $tagArtikelAdd.val());
                    formData.append('thumbnail_artikel', $thumbnailArtikelAdd[0].files[0]);
                    formData.append('isi_artikel', $('.ck-content').html());

                    errors.push(formRequired("judul_artikel_add", $judulArtikelAdd.val()));
                    errors.push(formRequired("kategori_artikel_add", $kategoriArtikelAdd.val()));
                    errors.push(formRequired("tag_artikel_add", $tagArtikelAdd.val()));
                    errors.push(formRequired("thumbnail_artikel_add", $thumbnailArtikelAdd.val()));
                    errors.push(formRequired("isi_artikel_add", $('.ck-content').html()));
                    
                    if(errors.indexOf(1) == -1){
                        addData(endpointAddData, formData, 'form-data');
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
                            $judulArtikelEdit.val(response.data.judul_artikel);
                            $kategoriArtikelEdit.val(response.data.kategori_artikel);
                            $tagArtikelEdit.val(response.data.tag_artikel);
                            // $isiArtikelEdit.val(response.data.isi_artikel);
                            editorEdit.setData(response.data.isi_artikel);
                        }
                    });
                });

                $("#btn-edit").click(function (e) { 
                    e.preventDefault();
                    $(".alert").hide();
                    $btn.prop('disabled', true);
                    var id = $(this).attr("data-id");
                    errors = [];

                    var formData = new FormData();
                    
                    formData.append('id', id);
                    formData.append('judul_artikel', $judulArtikelEdit.val());
                    formData.append('kategori_artikel', $kategoriArtikelEdit.val());
                    formData.append('tag_artikel', $tagArtikelEdit.val());
                    formData.append('thumbnail_artikel', $thumbnailArtikelEdit[0].files[0]);
                    formData.append('isi_artikel', editorEdit.getData());

                    errors.push(formRequired("judul_artikel_edit", $judulArtikelEdit.val()));
                    errors.push(formRequired("kategori_artikel_edit", $kategoriArtikelEdit.val()));
                    errors.push(formRequired("tag_artikel_edit", $tagArtikelEdit.val()));
                    errors.push(formRequired("isi_artikel_edit", editorEdit.getData()));
                    if(errors.indexOf(1) == -1){
                        updateData(endpointEditData, formData, 'form-data');
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


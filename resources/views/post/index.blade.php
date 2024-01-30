@extends('master')
@section('title','Post')
@push('style')

@endpush

@push('modal')
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Add Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                @csrf
                                <div class="mb-3">
                                    <label for="teammembersName" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="teammembersName"
                                           placeholder="Enter name" name="title">
                                </div>


                                <div class="mb-3">
                                    <label for="teammembersPass" class="form-label">Content</label>
                                    <textarea name="desc" id="" class="form-control" cols="10" rows="3"></textarea>
                                </div>


                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <i class="spinner fa ri-loader-2-line fa-spin spinner" style="display: none"></i>
                                    <button type="submit" class="btn btn-primary" id="addNewMember">Add Post</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--end modal-content-->
        </div>
    </div>

    <div class="modal fade flip" id="deleteModel" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                               colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                    <div class="mt-4 text-center">
                        <h4>Would you like to delete the Post ?</h4>
                        <p class="text-muted fs-15 mb-4">Deleting Post will remove all data of the Post from our
                            database.</p>
                        <div class="hstack gap-2 justify-content-center remove">
                            <input type="hidden" id="deleteId">
                            <button class="btn btn-link link-success fw-medium text-decoration-none"
                                    data-bs-dismiss="modal" id="close-delete-btn"><i
                                        class="ri-close-line me-1 align-middle"></i>Close
                            </button>
                            <button class="btn btn-danger" id="deleteBtn">
                                <i class="spinner fa fs-16 ri-loader-2-line fa-spin spinner" style="display: none"></i>
                                Yes, Delete It
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                </div>
                <form autocomplete="off" id="editForm">
                    @csrf
                    <div class="modal-body">
                        <div id="bodyMD">

                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success" id="updateBtn">
                                <i class="spinner fa ri-loader-2-line fa-spin spinner" style="display: none"></i>
                                Update Post
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endpush

@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Posts</h4>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-sm">
                        <div class="d-flex justify-content-sm-end">
                            <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
                                    data-bs-target="#addModal"><i
                                        class="ri-add-line align-bottom me-1"></i> Add Post
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table align-middle table-nowrap w-100" id="postTable"></table>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>

@endsection

@section('js')
    <script>
        let dataTable = $("#postTable").DataTable({
            retrieve: false,
            processing: true,
            responsive: true,
            serverSide: true,
            info: true,
            dom: "Blfrtip",
            lengthMenu: [
                [10, 25, 50, 75, -1],
                ["10 rows", "25 rows", "50 rows", "75 rows", "Show all"],
            ],
            columns: [
                {data: "DT_RowIndex", title: "Id", class: "text-center",},
                {data: "title", title: "Title", class: "text-center",},
                {data: "content", title: "Content", class: "text-center",},
                {data: "action", title: "action"},

            ],
            ajax: {
                url: '{{route('dashboard')}}',
                dataType: "JSON"
            },
            buttons: ["pageLength"],
            language: {
                zeroRecords: nodatafound,
                search: '',
                searchPlaceholder: 'Search Here..',
                processing: loadercontent,
                paginate: {
                    next: '<i class="ri-arrow-right-s-line">',
                    previous: '<i class="ri-arrow-left-s-line">'
                },
                info: '<label>Showing page _PAGE_ of _PAGES_</label>',
                infoEmpty: "No records available",
            },
            responsive: {
                breakpoints: [
                    {name: "desktop", width: Infinity},
                    {name: "tablet", width: 1024},
                    {name: "fablet", width: 768},
                    {name: "phone", width: 480},
                ]
            },
        });


        $("#addForm").validate({
            rules: {
                name: {required: true},
                desc: {required: true},
            },
            messages: {
                name: {required: "Please enter Post name"},

                desc: {required: "Please enter content"},
            },
            errorClass: "text-danger",
            submitHandler: function (form, e) {
                e.preventDefault();

                let formData = new FormData(form);
                $.ajax({
                    url: "{{route('add-post')}}",
                    method: 'post',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: true,
                    beforeSend: function () {
                        $('#addNewMember').attr('disabled', 'disabled');
                        $('.spinner').show();
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            Swal.fire({
                                title: "Success",
                                text: data.message,
                                icon: "success",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500
                            });
                            $('#addModal').modal('toggle');
                            $("#addForm").trigger("reset");
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                title: "Failed",
                                text: data.message,
                                icon: "warning",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500
                            });
                        }
                    },
                    complete: function () {
                        $('#addNewMember').removeAttr('disabled');
                        $('.spinner').hide();
                    }
                });
            }
        });

        $(document).on('click', '.deleteItem', function () {
            $("#deleteId").attr('value', $(this).prop('id'));
            $("#deleteModel").modal('toggle');
        })
        $("#deleteBtn").click(function () {
            $.ajax({
                url: "{{route('delete-post')}}",
                method: 'post',
                dataType: "json",
                data: {
                    'id': $("#deleteId").val(),
                    '_token': "{{csrf_token()}}"
                },
                beforeSend: function () {
                    $('#deleteBtn').attr('disabled', 'disabled');
                    $('.spinner').show();
                },
                success: function (data) {
                    if (data.status == 1) {
                        Swal.fire({
                            title: "Success",
                            text: data.message,
                            icon: "success",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500
                        });
                        $('#deleteModel').modal('toggle');
                        dataTable.ajax.reload(null, false);
                    } else {
                        Swal.fire({
                            title: "Failed",
                            text: data.message,
                            icon: "warning",
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            timer: 1500
                        });
                    }
                },
                complete: function () {
                    $('#deleteBtn').removeAttr('disabled');
                    $('.spinner').hide();
                }
            });
        });

        $(document).on('click', ".editItem", function () {
            $.ajax({
                url: "{{route('edit-post')}}",
                type: 'get',
                data: {
                    'id': $(this).prop('id'),
                    '_token': "{{csrf_token()}}"
                },
                success: function (data) {
                    $("#bodyMD").html(data);
                    $("#editModal").modal('toggle');

                },
                complete: function () {

                }

            });
        })

        $("#editForm").validate({
            rules: {
                name: {required: true},

                desc: {required: true},
            },
            messages: {
                name: {required: "Please enter Post name"},

                desc: {required: "Please enter Content"},
            },
            errorClass: "text-danger",
            submitHandler: function (form, e) {
                e.preventDefault();

                let formData = new FormData(form);

                $.ajax({
                    url: "{{route('update-post')}}",
                    method: 'post',
                    dataType: "json",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: true,
                    beforeSend: function () {
                        $('#updateBtn').attr('disabled', 'disabled');
                        $('.spinner').show();
                    },
                    success: function (data) {
                        if (data.status == 1) {
                            Swal.fire({
                                title: "Success",
                                text: data.message,
                                icon: "success",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500
                            });
                            $('#editModal').modal('toggle');
                            dataTable.ajax.reload(null, false);
                        } else {
                            Swal.fire({
                                title: "Failed",
                                text: data.message,
                                icon: "warning",
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                timer: 1500
                            });
                        }
                    },
                    complete: function () {
                        $('#updateBtn').removeAttr('disabled');
                        $('.spinner').hide();
                    }
                });
            }
        });

    </script>
@endsection

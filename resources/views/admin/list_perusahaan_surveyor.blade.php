@extends('template.backend.main')
@section('css')
@endsection
@section('content')


<!--begin::Content-->
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">

                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">

                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">
                        PERUSAHAAN SURVEYOR      
                    </h5>
                    <!--end::Page Title-->

                </div>
                <!--end::Page Heading-->

            </div>
            <!--end::Info-->

        </div>
    </div>
    <!--end::Subheader-->

    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">

        @if(Session::has('msg'))
            <!--begin::Notice-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="example">
                                <div class="example-preview">
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('msg')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Notice-->
        @elseif(Session::has('error'))
            <!--begin::Notice-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-body">
                            <div class="example">
                                <div class="example-preview">
                                    <div class="alert alert-success" role="alert">
                                        {{Session::get('error')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Notice-->
        @endif 

        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">
                        LIST PERUSAHAAN
                        <span class="d-block text-muted pt-2 font-size-sm">SURVEYOR</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <a href="#modalConfirm" class="btn btn-primary font-weight-bolder" data-toggle="modal">
                        <span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg><!--end::Svg Icon-->
                        </span>   INPUT DATA
                    </a>

                </div>
            </div>
            <div class="card-body">
                <!--Table-->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_tab_pane_4_1" role="tabpanel" aria-labelledby="kt_tab_pane_4_1">
                        <div class="col-xl-12">
                                <div class="table-responsive">
                                        <table class="table table-datatable table-custom" id="users-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <center>No</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama</center>
                                                    </th>
                                                    <th>
                                                        <center>Dokumen</center>
                                                    </th>
                                                    <!-- <th>
                                                        <center>Tanggal Input</center>
                                                    </th> -->
                                                    <th>
                                                        <center>Nama PIC</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td class="non_searchable"></td>
                                                    <td></td>
                                                    <!-- <td></td> -->
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="non_searchable"></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->


        </div>
        <!--end::Container-->

    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->


{{-- MODAL --}}
<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #3445E5">
                    <h2 class="modal-title" style="color: whitesmoke;"><strong>TAMBAH</strong> PERUSAHAAAN SURVEYOR</h2>
                </div>
                <form method="POST" id="register-form" action="{{ route('admin.addperusahaansurveyor') }}" role="form"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInput">Nama Perusahaan</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Perusahaan"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Email Perusahaan</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email Perusahaan" required>
                        </div>

                        <div class="form-group">
                            <label for="passwordInput">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Nama PIC</label>
                            <input type="text" class="form-control" id="pic" name="pic" placeholder="Nama PIC" required>
                        </div>
                       
                        <div class="form-group">
                            <label for="exampleInput">Dokumen Penugasan</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        <i class="fa fa-upload"></i>&nbsp;
                                        <input type="file" onchange="return validasiFile()"id="file" name="uploadpenugasan" required multiple="">
                                    </span>
                                </span>
                            </div>
                            <!-- <input type="file" id="file" onchange="return validasiFile()" name="uploadpenugasan"> -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Kembali</button>
                        <button style="background-color: rgb(77, 142, 192);color:white;" class="btn btn"> Simpan
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalConfirmedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #3445E5">
                    <h2 class="modal-title" style="color: whitesmoke;"><strong>EDIT</strong> PERUSAHAAAN SURVEYOR</h2>
                </div>
                <form method="POST" id="register-formedit" action="{{ route('admin.updateperusahaansurveyor') }}"
                    role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInput">Nama Perusahaan</label>
                            <input id="uuid" type="hidden" class="form-control" name="uuid">
                            <input id="status" type="hidden" class="form-control" name="status">
                            <input id="namaperusahaan" type="text" class="form-control" name="nama" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Email Perusahaan</label>
                            <input id="emailperusahaan" type="text" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="passwordInput">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Nama PIC</label>
                            <input type="text" class="form-control" id="picperusahaan" name="pic" placeholder="Nama PIC"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Dokumen Penugasan</label>
                            
                            <div class="input-group">
                            <span class="input-group-btn">
                                <span class="btn btn-primary btn-file">
                                    <i class="fa fa-upload"></i><input type="file" onchange="return validasiFileupdate()"
                                        id="uploadpenugasanperusahaan" name="uploadpenugasan" required multiple="">
                                </span>
                            </span>
                        </div>
                        <!-- <input type="file" id="file" onchange="return validasiFile()" name="uploadpenugasan"> -->
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Kembali</button>
                        <button style="background-color: rgb(77, 142, 192);color:white;" class="btn btn"> Simpan
                        </button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>


@endsection
@section('javascript')
<script>

    $( document ).ready(function() {
        $('.menu-item-active'). removeClass('menu-item-active');
        $('#surveyorperu'). addClass('menu-item-active');

    });
</script>
<script>
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.getanylistsurveyor') !!}',
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            // {data: 'created_at', name: 'created_at'},
            {data: 'nama_pic', name: 'nama_pic'},
            {data: 'aktifasi', name: 'aktifasi'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    function validasiFile() {
        var inputFile = document.getElementById('file');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.pdf)$/i;
        if (!ekstensiOk.exec(pathFile)) {
            alert('Silakan upload file yang memiliki ekstensi .pdf');
            inputFile.value = '';
            return false;
        } else {}
        var maxSize = '2048'; //2mb
        if (inputFile.files && inputFile.files[0]) {
            var fsize = inputFile.files[0].size / 1024;
            if (fsize > maxSize) {
                alert('Maximum file size exceed, This file size is: ' + fsize + " KB");
                inputFile.value = '';
                return false;
            } else {}
        }
    }

    function validasiFileupdate() {
        var inputFile = document.getElementById('uploadpenugasanperusahaan');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.pdf)$/i;
        if (!ekstensiOk.exec(pathFile)) {
            alert('Silakan upload file yang memiliki ekstensi .pdf');
            inputFile.value = '';
            return false;
        } else {}
        var maxSize = '2048'; //2mb
        if (inputFile.files && inputFile.files[0]) {
            var fsize = inputFile.files[0].size / 1024;
            if (fsize > maxSize) {
                alert('Maximum file size 2MB, This file size is: ' + fsize + " KB");
                inputFile.value = '';
                return false;
            } else {}
        }
    }


    function editps(uuid) {
        var url = "{{url('admin/editperusahaansurveyor')}}/" + uuid + "";
        $('#modalConfirmedit').modal('show');
        $.get(url, function(data) {

            $('#namaperusahaan').val(data[0].name)
            $('#emailperusahaan').val(data[0].email)
            $('#password').val(data[0].password_real)
            $('#uuid').val(data[0].uuid)
            $('#picperusahaan').val(data[0].nama_pic)

        });
    }


</script>
<script>
</script>
@endsection
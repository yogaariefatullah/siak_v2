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
                        IUP OP ANGKUT JUAL      
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
                        <span class="d-block text-muted pt-2 font-size-sm">IUP OPK ANGKUT JUAL</span>
                    </h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <div class="dropdown dropdown-inline mr-2">
                        
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                            </span>Export
                        </button>

                        <!--begin::Dropdown Menu-->
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <!--begin::Navigation-->
                            <ul class="navi flex-column navi-hover py-2">
                                <li class="navi-item">
                                    <a onclick="exportTableToExcel('users-table', 'IUP-ANGKUTJUAL-download-<?php echo  date('Y-m-d H:i:s'); ?>')" class="navi-link">
                                        <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                                        <span class="navi-text">Excel</span>
                                    </a>
                                </li>
                            </ul>
                            <!--end::Navigation-->
                        </div>
                        <!--end::Dropdown Menu-->

                    </div>
                    <!--end::Dropdown-->

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
                                                        <center>NO</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama</center>
                                                    </th>
                                                    <th>
                                                        <center>E-mail</center>
                                                    </th>
                                                    <th>
                                                        <center>Surat Penugasan</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td class="non_searchable"></td>
                                                    <td></td>
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
<div class="modal fade" id="modal_tolakperusahaan" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #3445E5">
                    <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">ALASAN</h2>
                </div>
                <div class="modal-body">
                    <form id="tolakperusahaan-form" action="{{url('admin/NonActive-Treader')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="exampleInput">&nbsp;</label>
                            <input type="hidden" id="txtIDperusahaan" name="txtIDperusahaan">
                            <input type="hidden" id="txt_flag" name="txt_flag">
                            <textarea class="form-control" id="alasan" name="alasan" placeholder="Masukan Alasan"
                                required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Kembali
                    </button>
                    <a id="btn_tolak" onclick="form_submittolak()"
                        style="background-color: rgb(77, 142, 192);color:white; display: none" class="btn btn"> Simpan
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modalConfirmedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #3445E5">
                    <h2 class="modal-title" style="color: whitesmoke;"><strong>EDIT</strong> PERUSAHAAN IUP OP ANGKUT JUAL</h2>
                </div>
                <form method="POST" id="register-formedit" action="{{ route('admin.update_trader') }}"
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
                            <input id="password" type="text" style="-webkit-text-security: disc;" class="form-control" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Nama PIC</label>
                            <input type="text" class="form-control" id="picperusahaan" name="pic" placeholder="Nama PIC"
                                required>
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
        $('#iupopaj'). addClass('menu-item-active');



    });
</script>
<script>
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.list_akun') !!}',
        columns: [
            {data: 'no', name: 'no'},
            {data: 'nama', name: 'nama'},
            {data: 'email', name: 'email'},
            {data: 'surat_penugasan', name: 'surat_penugasan'},
            {data: 'aktifasi', name: 'aktifasi'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false}
        ]
    });

    function delete_perusahaan(id) {
        var idnya = atob(id);
        $('#modal_tolakperusahaan').modal('show');
        $('#txtIDperusahaan').val(idnya);
        $('#txt_flag').val('delete');
        $('#myModalLabel').text('ALASAN HAPUS PERUSAHAAN')
    }
    function form_submittolak() {
        document.getElementById("tolakperusahaan-form").submit();
    }
    $('#alasan').bind('input propertychange', function() {
        if (this.value != '')
            $('#btn_tolak').show();
        else if (this.value == '')
            $('#btn_tolak').hide();
    });

    function viewandedit(id) {
        var url = "{{url('admin/edit_trader')}}/" + atob(id) + "";
        $('#modalConfirmedit').modal('show');
        $.get(url, function(data) {
            $('#namaperusahaan').val(data[0].nama)
            $('#emailperusahaan').val(data[0].email)
            $('#password').val('')
            $('#uuid').val(data[0].id_perusahaan)
            $('#picperusahaan').val(data[0].pic)
            
        });
    }

    function activate(id) {
        var idnya = atob(id);
        $('#modal_tolakperusahaan').modal('show');
        $('#txtIDperusahaan').val(idnya);
        $('#txt_flag').val('accept');
        $('#myModalLabel').text('ALASAN TERIMA PERUSAHAAN')
    }

    function tolakperusahaan(id) {
        $('#modal_tolakperusahaan').modal('show');
        $('#txtIDperusahaan').val(atob(id));
        $('#myModalLabel').text('ALASAN NON AKTIF PERUSAHAAN')
    }

</script>
<script>
    //export to excel
    function exportTableToExcel(tableID, filename = '') {
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');

        filename = filename ? filename + '.xls' : 'excel_data.xls';

        downloadLink = document.createElement("a");

        document.body.appendChild(downloadLink);

        if (navigator.msSaveOrOpenBlob) {
            var blob = new Blob(['\ufeff', tableHTML], {
                type: dataType
            });
            navigator.msSaveOrOpenBlob(blob, filename);
        } else {
            downloadLink.href = 'data:' + dataType + ', ' + tableHTML;

            downloadLink.download = filename;

            downloadLink.click();
        }
    }
</script>
@endsection
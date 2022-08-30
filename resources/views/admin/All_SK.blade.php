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
                        DAFTAR SK      
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
                        LIST SK
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
                                    <a onclick="exportTableToExcel('kt_datatable', 'trader-sk-download-<?php echo date('Y-m-d H:i:s'); ?>')" class="navi-link">
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
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                                <thead>
                                                <tr>
                                                    <th>
                                                        <center>No</center>
                                                    </th>
                                                    <th style="width: 50px;">
                                                        <center>No. SK Induk</center>
                                                    </th>
                                                    <th style="width: 80px;">
                                                        <center>Pemilik SK</center>
                                                    </th>
                                                    <th>
                                                        <center>Tanggal SK Terbit</center>
                                                    </th>
                                                    <th>
                                                        <center>Masa Berlaku SK</center>
                                                    </th>
                                                    <th>
                                                        <center>Dokumen SK</center>
                                                    </th>
                                                    <th style="width: 50px;">
                                                        <center>Status Approval</center>
                                                    </th>
                                                    <th>
                                                        <center>Aksi</center>
                                                    </th>
                                                </tr>
                                </thead>

                                <tbody>
                                                <?php $no = 1;?>
                                                @foreach($MST_SK as $rs)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$rs->no_sk}}</td>
                                                    <td>{{$rs->nama}}</td>
                                                    <td>{{$rs->tanggal_sk}}</td>
                                                    <?php
                                                        $date_expired = $rs->masa_berlaku;
                                                        $date_exp = \Carbon\Carbon::parse($date_expired);
                                                        $now = \Carbon\Carbon::now();
                                                        $diff = $now->diffInDays(($date_exp), false);
                                                    ?>
                                                    <td>
                                                        @if( $diff<= 30 && $diff>= 0)
                                                            <span class="label label-lg font-weight-bold label-inline label-light-warning">
                                                                {{$rs->masa_berlaku}}
                                                            </span>
                                                        @elseif($diff <= 0 )
                                                            <span class="label label-lg font-weight-bold label-inline label-light-danger">
                                                                {{$rs->masa_berlaku}}
                                                            </span>
                                                        @else
                                                            <span class="label label-lg font-weight-bold label-inline label-light-primary">
                                                                {{$rs->masa_berlaku}}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a class="label label-lg font-weight-bold label-inline label-light-info" target="_blank" rel="noopener noreferrer"
                                                            href="{{ url('/Upload_Dokumen')}}/{{$rs->dokumen}}">
                                                                Download
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($rs->status_approve == 0)
                                                        <span class="label label-warning label-dot mr-2"></span>
                                                        <span class="font-weight-bold text-warning">Menunggu Persetujuan</span>
                                                        @elseif($rs->status_approve == 1)
                                                        <span class="label label-success label-dot mr-2"></span>
                                                        <span class="font-weight-bold text-success">Telah di Setujui</span>
                                                        @else
                                                        <span class="label label-danger label-dot mr-2"></span>
                                                        <span class="font-weight-bold text-danger">Ditolak</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <center>
                                                            @if ($rs->status_approve == 0)
                                                                <button type="button" class="btn btn-outline-success btn-sm" onclick="approve('{{$rs->id_sk}}')"><i class="fa fa-check"></i> Approve</button>
                                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="tolaksk('{{$rs->id_sk}}')"><i class="fa fa-times"></i> Tolak</button>
                                                            @elseif($rs->status_approve == 1)
                                                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="tolakperusahaan('{{$rs->id_sk}}')" id="btn_tolakperusahaan"><i class="fa fa-times"></i> Tolak Perusahaan</button>
                                                            @endif
                                                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="detail('{{$rs->id_sk}}')" id="btn_detailsk"><i class="fa fa-eye"></i> Detail</button>
                                                        </center>
                                                    </td>
                                                </tr>
                                                @endforeach
                                </tbody>

                        </table>
                <!--end: Datatable-->
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
<div class="modal fade" id="modal_approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                                        <div class="modal-header" style="background: #3445E5">
                                            <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Approve
                                                SK</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form id="approve-form" action="{{url('admin/Approve-SK')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" id="txtIDska" name="IDska">
                                                <div class="table-responsive">
                                                    <table class="table table-datatable table-custom"
                                                        id="example_approve">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th >Nomor SK</th>
                                                                <th >Nama Pemilik SK</th>
                                                                <th >Nama Perusahaan</th>
                                                                <th >Volume</th>
                                                                <th >Jenis Perusahaan</th>
                                                                <th >Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="detailapprove">

                                                        </tbody>
                                                    </table>
                                                </div><hr>
                                                <div class="form-group">
                                                    <label for="exampleInput">Alasan</label>
                                                    <input type="hidden" id="txtIDsktolak1" name="txtIDsktolak1">
                                                    <textarea class="form-control" id="alasan2" name="alasan2"
                                                        placeholder="Alasan" required></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer" id="modal_footer">
                                            <button style="display: none;" id="btn-approve" onclick="form_submit()"
                                                class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                                Batal
                                            </button>
                                        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_tolakSK" tabindex="-1" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: #3445E5">
                                            <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">TOLAK
                                                SK</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tolaksk-form" action="{{url('admin/Tolak-SK')}}" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div class="form-group">
                                                    <label for="exampleInput">Alasan Penolakan</label>
                                                    <input type="hidden" id="txtIDsktolak" name="txtIDsktolak">
                                                    <textarea class="form-control" id="alasan" name="alasan"
                                                        placeholder="Alasan" required></textarea>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal"
                                                aria-hidden="true">Kembali
                                            </button>
                                            <a id="btn_tolak" onclick="form_submittolak()"
                                                style="background-color: rgb(77, 142, 192);color:white; display: none"
                                                class="btn btn"> Simpan </a>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                                <div class="modal-dialog modal-lg ">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: #3445E5">
                                            <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail
                                                SK</h2>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-datatable table-custom" id="example_detail">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th >Nomor SK</th>
                                                            <th >Nama Pemilik SK</th>
                                                            <th >Nama Perusahaan</th>
                                                            <th >Volume</th>
                                                            <th >Jenis Perusahaan</th>
                                                            <th >Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="detail">

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="modal-footer" id="modal_footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                                Batal
                                            </button>
                                        </div>

                                    </div>

                                </div>
</div>

<div class="modal fade" id="modal_tolakperusahaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
                                <div class="modal-dialog modal-lg ">
                                    <div class="modal-content">
                                        <div class="modal-header" style="background: blue">
                                            <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Tolak
                                                Perusahaan</h2>
                                        </div>
                                        <div class="modal-body">
                                            <form id="tolak-form" action="{{url('admin/Tolak-Perusahaan')}}"
                                                method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" id="txtIDsk" name="IDsk">
                                                <div class="table-responsive">
                                                    <table class="table table-datatable table-custom"
                                                        id="example_approve">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th >Nomor SK</th>
                                                                <th >Nama Pemilik SK</th>
                                                                <th >Nama Perusahaan</th>
                                                                <th >Volume</th>
                                                                <th >Jenis Perusahaan</th>
                                                                <th >Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="detailtolakperusahaan">

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer" id="modal_footer">
                                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">
                                                Batal
                                            </button>
                                        </div>
                                    </div>

                                </div>
</div>


@endsection
@section('javascript')
<script>

    $( document ).ready(function() {
        $('.menu-item-active'). removeClass('menu-item-active');
        $('#listsk'). addClass('menu-item-active');
    });
</script>
<script>
    
    function approve(id_sk) {

        var url = "{{url('admin/Detail-SK')}}/" + id_sk + "";

        $('#tbody#detail').empty();
        $('#modal_approve').modal('show');
        $('#txtIDska').val(id_sk);

        var htmls = '';
        $.get(url, function(data) {

            //console.log(data);
            var i = 1;
            $.each(data, function(key, value) {

                htmls += '<tr>';
                htmls += '<td>' + i++ + '</td>';
                htmls += '<td>' + value.no_sk_no + '</td>';
                htmls += '<td>' + value.nama_pemilik + '</td>';
                htmls += '<td>' + value.nama_penambang + '</td>';
                htmls += '<td>' + value.volume + '</td>';
                htmls += '<td>' + value.jenis_perusahaan + '</td>';
                htmls += '<td><input checked="" name="ck_sk[]" value="' + value.id +
                    '" type="checkbox"></td>';
                htmls += '</tr>';

            });
            $('tbody#detailapprove').html(htmls);
            console.log(i - 1);
        });

    }

    $('#alasan').bind('input propertychange', function() {
        if (this.value != '')
            $('#btn_tolak').show();
        else if (this.value == '')
            $('#btn_tolak').hide();
    });
    $('#alasan2').bind('input propertychange', function() {
        if (this.value != '')
            $('#btn-approve').show();
        else if (this.value == '')
            $('#btn-approve').hide();
    });

    function form_submit() {
        document.getElementById("approve-form").submit();
    }


    function tolaksk(id_sk) {

        var urltolak = "{{url('admin/Tolak-SK')}}/" + id_sk + " ";
        $('#modal_tolakSK').modal('show');
        $('#txtIDsktolak').val(id_sk);
    }

    function form_submittolak() {
        document.getElementById("tolaksk-form").submit();
    }


    function detail(id_sk) {

        var url = "{{url('admin/Detail-SK')}}/" + id_sk + "";

        $('#tbody#detail').empty();
        $('#modal_detail').modal('show');

        var htmls = '';
        $.get(url, function(data) {

            var i = 1;
            $.each(data, function(key, value) {

                htmls += '<tr>';
                htmls += '<td>' + i++ + '</td>';
                htmls += '<td>' + value.no_sk_no + '</td>';
                htmls += '<td>' + value.nama_pemilik + '</td>';
                htmls += '<td>' + value.nama_penambang + '</td>';
                htmls += '<td>' + value.volume + '</td>';
                htmls += '<td>' + value.jenis_perusahaan + '</td>';
                if (value.status_approve == true) {
                    htmls += '<td>Diterima</td>';
                } else {
                    htmls += '<td>Ditolak</td>';
                }

                htmls += '</tr>';

            });

            $('tbody#detail').html(htmls);

        });
    }


    function tolakperusahaan(id_sk) {
        var url = "{{url('admin/Detail-SK')}}/" + id_sk + "";
        $('#tbody#detail').empty();
        $('#modal_tolakperusahaan').modal('show');
        $('#txtIDsk').val(id_sk);
        var htmls = '';
        $.get(url, function(data) {
            var i = 1;
            $.each(data, function(key, value) {
                console.log(value);
                var akctive_sk_detail = "{{url('admin/sk_detai_aktif')}}/" + value.id_perusahaan + "/" +
                    id_sk;
                var nonaktif_sk_detail = "{{url('admin/sk_detai_nonaktif')}}/" + value.id_perusahaan +
                    "/" + id_sk;
                var urlnonaktifpenambang = "{{url('admin/Update-misverask')}}/" + value.id_perusahaan +
                    "/0/";
                var urlaktifkanpenambang = "{{url('admin/Update-misverask')}}/" + value.id_perusahaan +
                    "/1/";
                var urlnonaktiftrader = "{{url('admin/NonActive-Treadersk')}}/" + value.id_perusahaan +
                    "/" + value.id_sk;
                var urlaktifkantrader = "{{url('admin/Active-Treadersk')}}/" + value.id_perusahaan +
                    "/" + value.id_sk;
                htmls += '<tr>';
                htmls += '<td>' + i++ + '</td>';
                htmls += '<td>' + value.no_sk_no + '</td>';
                htmls += '<td>' + value.nama_pemilik + '</td>';
                htmls += '<td>' + value.nama_penambang + '</td>';
                htmls += '<td>' + value.volume + '</td>';
                htmls += '<td>' + value.jenis_perusahaan + '</td>';
                //console.log(value.jenis_perusahaan);
                // if (value.jenis_perusahaan == 'IUP OP/ PKB2B / IUPK') {
                if (value.status_approve == true) {
                    htmls += '<td> <a href="' + nonaktif_sk_detail +
                        '" class="btn btn-light-danger font-weight-bold mr-2"><i class="fa fa-times"></i> Non Aktifkan</a></td>';
                } else {
                    htmls += '<td> <a href="' + akctive_sk_detail +
                        '" class="btn btn-light-primary font-weight-bold mr-2"><i class="fa fa-check"></i> Aktifkan Kembali</a></td>';
                }

                htmls += '</tr>';
            });
            $('tbody#detailtolakperusahaan').html(htmls);
        });
    }



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

{{-- Datatable --}}
<script src="{{ url('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{ url('assets/js/pages/crud/datatables/data-sources/html.js')}}"></script>
@endsection
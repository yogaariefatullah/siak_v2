@extends('template.backend.main')
@section('css')
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2"></div>
            <div class="d-flex align-items-center flex-wrap">
                @if($cek == null)
                <a href="{{url('Add_SK')}}" class="btn btn-primary btn-sm">Tambah SK</a>
                @elseif($status_approve == 1)
                <!--- aktif dan diterima -->
                <!-- <a onclick="cekPenambahan()" class="btn btn-success btn-sm"> Penambahan SK</a> -->
                <a href="{{route('traders.add_sk.mineral')}}" class="btn btn-primary btn-sm">Tambah SK</a>
                <a href="{{route('traders.perpanjang_sk.mineral')}}" class="btn btn-warning btn-sm">Perpanjangan SK</a>
                @elseif($status_approve == 0 && $status_penambahan >= 1)
                <!-- penambahan aktif tapi belom di approve -->
                <!-- <a onclick="cekPenambahan()" class="btn btn-success btn-sm"> Penambahan SK</a> -->
                @elseif($status_approve == 0 && $status_perpanjangan >= 1)
                <!-- perpanjangan aktif tapi belom di approve -->
                @elseif($status_approve == 0 )
                <!-- aktif tapi belom di approve -->
                @endif
            </div>

        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class=" container ">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">

            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">
                                    Daftar SK
                                </h3>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="table-responsive">
                                <table class="table table-datatable table-custom" id="advancedDataTable">
                                    <thead>
                                        <tr>
                                            <th class="sort-alpha">
                                                <center>No</center>
                                            </th>
                                            <th class="sort-alpha">
                                                <center>No. SK Induk</center>
                                            </th>
                                            <th>
                                                <center>Tanggal SK Terbit</center>
                                            </th>
                                            <th>
                                                <center>Masa Berlaku SK</center>
                                            </th>
                                            <th>
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($res as $rs)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$rs->no_sk}}</td>
                                            <td>{{tgl_indo($rs->tanggal_sk)}}</td>
                                            @php
                                            $date_expired = $rs->masa_berlaku;
                                            $date_exp = \Carbon\Carbon::parse($date_expired);
                                            $now = \Carbon\Carbon::now();
                                            $diff = $now->diffInDays(($date_exp), false);
                                            @endphp
                                            <td>
                                                @if($diff<= 30 && $diff>= 0)
                                                    <p class="text-warning">{{tgl_indo($rs->masa_berlaku)}}</p>
                                                    @elseif($diff <= 0) <p class="text-danger">{{tgl_indo($rs->masa_berlaku)}}</p>
                                                        @else
                                                        <p>{{tgl_indo($rs->masa_berlaku)}}</p>
                                                        @endif
                                            </td>

                                            <td>
                                                <button onclick="showDetail('{{$rs->id_sk}}','{{$rs->no_sk}}');" data-toggle="modal" data-target="#modal_detail" data-item="" class="btn btn-slategray margin-bottom-20"><i class="fa fa-eye"></i>&nbsp;Details</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

<div class="modal fade bs-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail SK</h2>
            </div>
            <div class="modal-body" id="body_modal_detail">
                <div class="row" id="detail" style="display:none;">
                    <button class="btn btn-sm btn-success"><span class="fa fa-refresh fa-refresh-animate"></span>
                        Loading...</button>
                </div>
                <div class="body-content"></div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hideDetail()">Tutup</button>
            </div>
        </div>
    </div>
</div>


@endsection
@section('javascript')

<script>
    $('#advancedDataTable').DataTable();

    function showDetail(id_sk, no_sk) {
        var no_sk = btoa(no_sk);
        var id_sk = btoa(id_sk);
        $('.body-content').show();
        $.ajax({
            url: "{{route('traders.sk.mineral')}}",
            data: {
                id_sk: id_sk,
                no_sk: no_sk,
            },
            beforeSend: function() {
                $('#detail').show();
            },
            complete: function() {
                $('#detail').hide();
            },
            success: function(data) {
                $('.body-content').html(data);
                //$('#detail').show();
                //console.log("load data");
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
        $('#modal_detail').modal('show');
    }

    function hideDetail() {
        $('.body-content').remove();
        $('#body_modal_detail').html('<div class="body-content"></div>')
    }
</script>
@endsection
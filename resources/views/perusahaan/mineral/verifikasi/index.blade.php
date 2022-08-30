@extends('template.backend.main')
@section('css')
@endsection
@section('content')
<div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6  subheader-transparent " id="kt_subheader">
        <div class=" container  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-2"></div>
            <div class="d-flex align-items-center flex-wrap">

            </div>

        </div>
    </div>
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">Verifikasi Pembelian Mineral</h3>
                            </div>
                            <div class="card-toolbar">
                                <ul class="nav nav-light-success nav-bold nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_4_1">
                                            <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                            <span class="nav-text text-white">Perusahaan Tambang</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4_2">
                                            <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                            <span class="nav-text text-white">IUP OPK</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
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
                                                            <center>No. Transaksi</center>
                                                        </th>
                                                        <th>
                                                            <center>Tanggal</center>
                                                        </th>
                                                        <th>
                                                            <center>Pelabuhan Asal</center>
                                                        </th>
                                                        <th>
                                                            <center>Pelabuhan Tujuan</center>
                                                        </th>
                                                        <th>
                                                            <center>Penjual</center>
                                                        </th>
                                                        <th>
                                                            <center>Aksi</center>
                                                        </th>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <td class="non_searchable"></td>
                                                        <td></td>
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
                                <div class="tab-pane fade" id="kt_tab_pane_4_2" role="tabpanel" aria-labelledby="kt_tab_pane_4_2">
                                    <div class="col-xl-12">
                                        <div class="table-responsive">
                                            <table class="table table-datatable table-custom" id="trader-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <center>No</center>
                                                        </th>
                                                        <th>
                                                            <center>No. Transaksi</center>
                                                        </th>
                                                        <th>
                                                            <center>Tanggal</center>
                                                        </th>
                                                        <th>
                                                            <center>Pelabuhan Asal</center>
                                                        </th>
                                                        <th>
                                                            <center>Pelabuhan Tujuan</center>
                                                        </th>
                                                        <th>
                                                            <center>Penjual</center>
                                                        </th>
                                                        <th>
                                                            <center>Aksi</center>
                                                        </th>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <td class="non_searchable"></td>
                                                        <td></td>
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
                </div>

            </div>
            <div class="row">
            </div>
            <div class="row">
            </div>
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

<!-- modal -->
<div class="modal fade bs-example-modal-lg" id="modal_detail" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content">
            <div class="modal-header" style="background: #1aa3ff">
                <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;">Detail Pemasaran</h2>
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
<!-- modal-->

@endsection
@section('javascript')

<script>
    $(function() {

        @if($cek == 'gagal')
        Swal.fire(
            'Inventori Berlebih, Silahkan Melakukan Pemasaran',
            '',
            'error'
        );
        @endif


        @if(Session::has('success'))
        Swal.fire(
            'Transaksi diterima',
            '',
            'success'
        );
        @endif
        @if(Session::has('error'))
        Swal.fire(
            'Error pada controller',
            '',
            'success'
        );
        @endif
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('traders.verifikasi.mineral.data_pemasaran_perusahaan')}}",
            columns: [{
                    data: "no",
                    name: "no",
                    width: "3%"
                },
                {
                    data: "id_transaksi",
                    name: "id_transaksi"
                },
                {
                    data: "date",
                    name: "date"
                },
                {
                    data: "pelabuhan_asal",
                    name: "pelabuhan_asal"
                },
                {
                    data: "pelabuhan_tujuan",
                    name: "pelabuhan_tujuan"
                },
                {
                    data: "penjual",
                    name: "penjual"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: "3%"
                }
            ]
        });

        var table2 = $('#trader-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('traders.verifikasi.mineral.data_pemasaran_trader')}}",
            columns: [{
                    data: "no",
                    name: "no",
                    width: "3%"
                },
                {
                    data: "id_transaksi",
                    name: "id_transaksi"
                },
                {
                    data: "date",
                    name: "date"
                },
                {
                    data: "pelabuhan_asal",
                    name: "pelabuhan_asal"
                },
                {
                    data: "pelabuhan_tujuan",
                    name: "pelabuhan_tujuan"
                },
                {
                    data: "penjual",
                    name: "penjual"
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: "3%"
                }
            ]
        });

        // //https://www.gyrocode.com/articles/jquery-datatables-column-width-issues-with-bootstrap-tabs/
        // $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        //     $($.fn.dataTable.tables(true)).DataTable()
        //         .columns.adjust();
        // });

        $(document.body).on('click', '.js-submit-confirm2', function(event) {
            event.preventDefault();
            $('#modal_detail').modal('hide');
            var $form = $(this).closest('form');

            Swal.fire({
                title: 'Yakin bukan transaksi anda?',
                input: 'text',
                type: 'warning',
                inputPlaceholder: 'Alasan ditolak',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-times"></i>&nbsp;Tolak',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result === false) return false;
                if (result.value) {
                    $.post(
                        "{{ url('verifikasi/batubara/reject/').'/'}}" + $('#id_pemasaran').val(), {
                            _token: '{{ csrf_token() }}',
                            alasan: result.value
                        },
                        function(res) {
                            Swal.fire(
                                'Transaksi ditolak',
                                '',
                                'success'
                            );
                            $('#modal_detail').modal('hide');
                            table.ajax.reload();
                        }
                    );
                }
            });
        });

        $(document.body).on('click', '.js-submit-confirm-tolak_trader', function(event) {
            event.preventDefault();
            $('#modal_detail').modal('hide');
            var $form = $(this).closest('form');

            Swal.fire({
                title: 'Yakin bukan transaksi anda?',
                input: 'text',
                type: 'warning',
                inputPlaceholder: 'Alasan ditolak',
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-times"></i>&nbsp;Tolak',
                confirmButtonColor: '#d33',
            }).then((result) => {
                if (result === false) return false;
                if (result.value) {
                    $.post(
                        "{{ url('verifikasi/batubara/tolak_trader/').'/'}}" + $('#id_pemasaran').val(), {
                            _token: '{{ csrf_token() }}',
                            alasan: result.value
                        },
                        function(res) {
                            Swal.fire(
                                'Transaksi ditolak',
                                '',
                                'success'
                            );
                            $('#modal_detail').modal('hide');
                            table.ajax.reload();
                            refresh();
                        }
                    );
                }
            });
        });

    });

    function showDetail(id_pemasaran) {
        $('.body-content').show();
        $.ajax({
            url: "{{route('traders.verifikasi.mineral.detail_pemasaran_perusahaan')}}",
            data: {
                id_pemasaran: id_pemasaran
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

    function showtrader(id_pemasaran) {
        $('.body-content').show();
        $.ajax({
            url: "{{route('traders.verifikasi.mineral.detail_pemasaran_trader')}}",
            data: {
                id_pemasaran: id_pemasaran
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
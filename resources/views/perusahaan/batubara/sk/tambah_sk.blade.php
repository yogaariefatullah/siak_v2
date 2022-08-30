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
                                    Tambah SK
                                </h3>
                            </div>
                        </div>
                        <form class="form-horizontal" id="form_sk" method="post" action="{{route('traders.sk.store')}}" enctype="multipart/form-data" role="form">

                            <div class="card-body" style="background-color: whitesmoke;">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Nomor SK:</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" placeholder="Nomor SK" name="no_sk" id="no_sk" required />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Tanggal Pembuatan SK:</label>
                                            <div class="col-lg-8">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" name="tanggal_sk" placeholder="Tanggal Pembuatan SK" id="tgl_transaksi" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Lampiran Dokumen:</label>
                                            <div class="col-lg-8">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="customFile" accept=".pdf" id="customFile" required>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Masa Berlaku SK:</label>
                                            <div class="col-lg-8">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control" name="masa_berlaku" placeholder="Masa Berlaku SK" id="masa_berlaku" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <br /><br />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row" id="divSumberBatubara">
                                            <label class="col-sm-4 form-control-label">Sumber Batubara</label>
                                            <div class="col-sm-8">
                                                <div class="radio-inline">
                                                    <label class="radio radio-outline radio-primary">
                                                        <input type="radio" id="rad1" name="jenis" value="IUP OPK Pengangkutan / Penjualan" />
                                                        <span></span>
                                                        IUP OPK Pengangkutan / Penjualan
                                                    </label>
                                                    <label class="radio radio-outline radio-primary">
                                                        <input type="radio" id="rad2" name="jenis" value="IUP OP/ PKB2B / IUPK" />
                                                        <span></span>
                                                        IUP OP/ PKB2B / IUPK
                                                    </label>
                                                </div>
                                                <span class="form-text text-muted">Sumber Batubara</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Perusahaan:</label>
                                            <div class="col-lg-8">
                                                <select class="form-control" id="perusahaan" name="perusahaan">
                                                    <option></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Jumlah Volume:</label>
                                            <div class="col-lg-8">
                                                <div class="input-group date">
                                                    <input type="text" class="form-control volume" placeholder="Volume" name="volume" id="volume" />
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <strong>Ton</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">&nbsp;</label>
                                            <div class="col-lg-8">
                                                <button class="btn btn btn-primary btn-shadow font-weight-bold mr-2" id="btn_add_more_direksi" type="button"><i class="flaticon-plus"></i> Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div id="formRPembelianR" class="col-md-12">
                                                <div class="row batasRemove"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br /><br />
                                <div class="row">
                                    <input type="hidden" id="count" value="" />
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-between bg-color-navy">
                                &nbsp;
                                <button type="submit" class="btn btn-success font-weight-bold">Simpan</button>
                            </div>
                        </form>
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


@endsection
@section('javascript')
<script>
    $('#perusahaan').select2({
        placeholder: "- Pilih Perusahaan -",
        allowClear: true,
    });
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
</script>
<script>
    $('#advancedDataTable').DataTable();

    $('#tgl_transaksi').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "auto bottom",
        todayHighlight: true,
        templates: arrows,
        format: "dd/mm/yyyy"
    });

    $('#masa_berlaku').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "auto bottom",
        todayHighlight: true,
        templates: arrows,
        format: "dd/mm/yyyy"
    });

    function clear() {
        $('#volume').val('');
        $('#perusahaan').val(null).trigger('change');
        $("#perusahaan").empty().trigger('change');
    }

    $('#rad1').click(function() {
        clear();
        $.ajax({
            url: "{{route('traders.perusahaan_trader.bb')}}",

            beforeSend: function() {
                // $('#detail').show();
            },
            complete: function() {
                // $('#detail').hide();
            },
            success: function(data) {
                // console.log(data);
                //$('#detail').show();
                //console.log("load data");
                for (let index = 0; index < data.length; index++) {
                    var newOption = new Option(data[index].nama, data[index].id_perusahaan, false, false);
                    // console.log(data[index].nama);
                    $('#perusahaan').append(newOption).trigger('change');
                }

            },
            error: function(data) {
                // console.log("gagal load data");
                clear();
            }
        });
    });

    $('#rad2').click(function() {
        clear();
        var jenis = $('#perusahaan');

        var test = "";
        var test2 = "";
        $.ajax({
            url: "{{route('traders.perusahaan_tambang.bb')}}",

            beforeSend: function() {
                // $('#detail').show();
            },
            complete: function() {
                // $('#detail').hide();
            },
            success: function(data) {
                // console.log(data);
                //$('#detail').show();
                //console.log("load data");
                for (let index = 0; index < data.length; index++) {
                    var newOption = new Option(data[index].nama, data[index].id_perusahaan, false, false);
                    // console.log(data[index].nama);
                    $('#perusahaan').append(newOption).trigger('change');
                }

            },
            error: function(data) {
                // console.log("gagal load data");
                clear();
            }
        });
        // console.log(test2);
    });

    $(document).ready(function() {
        var no = 1;
        var perusahaan = 1;
        var sumber = 1;
        var sumber_id = 1;
        var perusahaan_id = 1;
        var maxGroup = 20;
        $("#addmore").click(function() {


        });
    });

    $('#btn_add_more_direksi').click(function(e) {
        var id_perusahaan = $('#perusahaan').val();
        var nama_perusahaan = $('#perusahaan option:selected').text();
        var volume = $('#volume').val();
        var jenis_perusahaan = $('input[name=jenis]:checked', '#form_sk').val();
        if (nama_perusahaan.length > 0 && id_perusahaan.length > 0 && volume.length > 0) {
            $('#formRPembelianR').append(`
                    <div class="row batasRemove">
                        <div class="col-md-12">
                            <div class="card border-primary">
                                <div class="card-body text-primary">
                                    <button type="button" class="close removeFormPembelianR">&times;</button>
                                    <p> Nama Perusahaan : ` + nama_perusahaan + ` </p>
                                    <p> Volume : ` + volume + `</p>
                                    <input type="hidden" name="nama_perusahaan_array[]" value="` + nama_perusahaan + `" />
                                    <input type="hidden" name="id_perusahaan_array[]" value="` + id_perusahaan + `" />
                                    <input type="hidden" name="volume_array[]" value="` + volume + `" />
                                    <input type="hidden" name="jenis_perusahaan_array[]" value="` + jenis_perusahaan + `" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                `);
            var count = $('#count').val();
            $('#count').val(parseInt(count) + 1);
            clear();
            $('.removeFormPembelianR').click(function(e) {

                if ($(this).closest('#formRPembelianR').children().length == 1) {
                    Swal.fire({
                        text: "Minimal 1 Staff Terdaftar",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light"
                        }
                    });
                } else {
                    $('#count').val(parseInt(count) - 1);
                    $(this).closest('.batasRemove').remove();
                }
            });
        } else {
            Swal.fire({
                text: "Harap Isi Data Yang Masih Kosong",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light"
                }
            });
        }


    });
</script>
@endsection
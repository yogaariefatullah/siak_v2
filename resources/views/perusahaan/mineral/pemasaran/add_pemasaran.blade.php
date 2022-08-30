<form class="form" action="{{route('traders.pemasaran_mn.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
    {{csrf_field()}}
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">No Transaksi:</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="kode_transaksi" required placeholder="Nomor Transaksi" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Tanggal Transaksi:</label>
                    <div class="col-lg-8">
                        <div class="input-group date">
                            <input type="text" class="form-control" name="tgl_transaksi" required placeholder="Tanggal Pemasaran" id="tgl_transaksi">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-check-circle-o"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">


                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Sistem Penjualan:</label>
                    <div class="col-lg-8">
                        <?php $pemasaran = master_jenis_pemasaran_data(); ?>
                        <select class="form-control" name="jenis_pemasaran" required id="kt_select2">
                            <option></option>
                            @foreach($pemasaran as $pmsrn)
                            <option value="{{$pmsrn->id_jenis_pemasaran}}">{{$pmsrn->jenis_pemasaran}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Pelabuhan Muat:</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="pelabuhan_muat" required placeholder="Pelabuhan Muat" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Lokasi Pelabuhan Muat</label>
                    <div class="col-lg-8">
                        <?php $prov = get_provinsi_data(); ?>
                        <select class="form-control" name="lokasi_pelabuhan_muat" required id="kt_select1">
                            <option></option>
                            @foreach($prov as $p)
                            <option value="{{$p->id_provinsi}}">{{$p->nama_provinsi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Pelabuhan Tujuan:</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="pelabuhan_ts" required placeholder="Pelabuhan Tujuan" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nama Kapal:</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="nama_kapal" required placeholder="Nama Kapal" />
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Jenis Penjualan:</label>
                    <div class="col-lg-8">
                        <?php $penjualan = master_jenis_penjualan_data(); ?>
                        <select class="form-control" required name="jenis_penjualan" id="kt_select3">
                            <!-- <option disabled selected>-- PILIH --</option> -->
                            <option></option>
                            @foreach($penjualan as $pnjln)
                            <option value="{{$pnjln->id_jenis_penjualan}}">{{$pnjln->jenis_penjualan}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Kategori Pembeli:</label>
                    <div class="col-lg-8">
                        <select class="form-control" id="akategori_pembeli" required name="kategori_pembeli">
                            <option value="" selected disabled>Pilih</option>
                            <option value="1">IUP OPK Pengangkutan dan Penjualan</option>
                            <option value="2">End User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Mata Uang:</label>
                    <div class="col-lg-8">
                        <select class="form-control form-controller-solid" required name="mata_uang" id="mata_uang">
                            <option selected disabled>-Pilih-</option>
                            <option value="IDR">IDR</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nama Produk:</label>
                    <div class="col-lg-8">
                        <?php $produk = get_produk_data(Auth::guard('traders')->user()->id_perusahaan); ?>
                        <select class="form-control" id="jenis_produk" required name="jenis_produk">
                            <option value="" selected disabled>Pilih</option>
                            @foreach($produk as $prod)
                            <option value="{{$prod->id_produk}}">{{get_produk_id($prod->id_produk)}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Negara Tujuan:</label>
                    <div class="col-lg-8">
                        <select class="form-control" required id="kt_select4">
                            <option></option>
                           
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nama Pembeli:</label>
                    <div class="col-lg-8">
                        <select class="form-control form-controller-solid" required name="id_master_pembeli" id="kt_select5">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Volume:</label>
                    <div class="col-lg-8">
                        <input type="text" required class="form-control volume_mn" name="volume" />
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-4 col-form-label">Terbit LHV :</label>
                    <div class="col-8 col-form-label">
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" id="cetak" name="Checkboxes15" onclick="cookingcoal();" />
                                <span></span>

                            </label>
                        </div>
                        <span class="form-text text-muted">Harap Checklist bila ingin mendapatkan LHV</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="layout_surveyor">
                <div class="form-group row">
                    <label class="col-4 col-form-label">Surveyor Pelaksana Muat :</label>
                    <div class="col-md-8 col-form-label">
                        <select class="form-control" id="surveyor" name="surveyor">
                            <option></option>
                            <?php $surveyor = surveyor_data(); ?>
                            @foreach($surveyor as $s)
                            <option value="{{$s->uuid}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center mt-10"><span id="loader_kadar" class="spinner spinner-primary spinner-lg"></span></div>
                <div id="kadar_body">

                </div>
            </div>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-between">
        &nbsp;&nbsp;
        <div class="row">
            <button type="submit" class="btn btn-success">Simpan</button> &nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="return hide_add()">Tutup</button>
        </div>
    </div>

</form>
<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.6')}}"></script>
<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script>
    function hide_add() {
        $('.body-content').remove();
        $('#body_modal_detail').html('<div class="body-content"></div>')
    }

    $('.volume_mn').inputmask({
        alias: "decimal",
        digits: 3,
        repeat: 36,
        digitsOptional: false,
        decimalProtect: true,
        groupSeparator: ".",
        placeholder: '0',
        rightAlign: false,
        radixPoint: ",",
        radixFocus: true,
        autoGroup: true,
        autoUnmask: false,
        onBeforeMask: function(value, opts) {
            return value;
        },
        removeMaskOnSubmit: true
    });

    $('#akategori_pembeli').select2({
        placeholder: "- Kategori Pembeli -",
        allowClear: true,
    });
    $('#kt_select4').select2({
        placeholder: "- Negara Tujuan -",
        allowClear: true,
    });
    $('#kt_select3').select2({
        placeholder: "- Pilih Jenis Penjualan -",
        allowClear: true,
    });
    $('#kt_select2').select2({
        placeholder: "- Pilih Jenis Pemasaran -",
        allowClear: true,
    });
    $('#kt_select1').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });

    $('#jenis_produk').select2({
        placeholder: "- Pilih Produk -",
        allowClear: true,
    });

    $('#jenis_produk').on('change', function() {
        var id_produk = $('#jenis_produk').val();

    });

    $('#kt_select5').select2({
        placeholder: "- Pembeli -",
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

    $('#tgl_transaksi').datepicker({
        rtl: KTUtil.isRTL(),
        orientation: "Tanggal Pemasaran",
        todayHighlight: true,
        templates: arrows,
        format: "dd/mm/yyyy"
    });
    $(document).ready(function() {
        $('#layout_surveyor').hide();
        $('#loader_kadar').hide();
    });

    function cookingcoal() {
        if (document.getElementById('cetak').checked) {
            $('#layout_surveyor').show();
            $('#surveyor').select2({
                placeholder: "- Pilih Surveyor -",
                allowClear: true,
            });
        } else {
            $('#layout_surveyor').hide();
            $('#layout_surveyor').val('');
            $('#surveyor').select2({
                placeholder: "- Pilih Surveyor -",
                allowClear: true,
            });
        }
    }
</script>
<script>
    $('#akategori_pembeli').on('change', function(e) {
        var values = this.value;

        if (values == '1') {
            $("#kt_select5").empty().trigger('change');

            $.ajax({
                url: "{{route('traders.perusahaan_trader.mineral')}}",

                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    for (let index = 0; index < data.length; index++) {
                        var newOption = new Option(data[index].nama, data[index].id_perusahaan, false, false);
                        // console.log(data[index].nama);
                        $('#kt_select5').append(newOption).trigger('change');
                    }

                },
                error: function(data) {
                    // console.log("gagal load data");
                    clear();
                }
            });
        } else {
            $("#kt_select5").empty().trigger('change');
            $.ajax({
                url: "{{route('traders.pemasaran.master_pembeli')}}",

                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    for (let index = 0; index < data.length; index++) {
                        var newOption = new Option(data[index].nama_pembeli, data[index].id_pembeli, false, false);
                        $('#kt_select5').append(newOption).trigger('change');
                    }

                },
                error: function(data) {
                    clear();
                }
            });
        }
    });

    $('#jenis_produk').on('change', function(e) {
        var values = this.value;
        $.ajax({
            url: "{{route('traders.master_kualitas.mineral')}}",
            data: {
                id_produk: values
            },
            beforeSend: function() {
                $('#loader_kadar').show();
            },
            complete: function() {
                $('#loader_kadar').hide();
            },
            success: function(data) {
                $('#loader_kadar').hide();
                $('#kadar_body').html(data);
            },
            error: function(data) {
                // console.log("gagal load data");
            }
        });
    });

    $('#kt_select3').on('change', function(e) {
        var values = this.value;

        $("#kt_select4").empty().trigger('change');
        $.ajax({
            type: "POST",
            url: "{{route('traders.master_negara')}}",
            data: {
                _token: "{{csrf_token()}}",
                id: values
            },
            success: function(data) {
                for (let index = 0; index < data.length; index++) {
                    var newOption = new Option(data[index].negara, data[index].id_negara, false, false);
                    $('#kt_select4').append(newOption).trigger('change');
                }
                // console.log(data);
            },
            error: function(data) {
                console.log(data);
                clear();
            }
        });

    });

    // function confirm() {
    //     if()
    //     if ($('#jenis_produk').val() != null) {
    //         event.preventDefault(); // prevent form submit
    //         var form = event.target.form; // storing the form
    //         Swal.fire({
    //             title: 'Apakah Data yang di Masukan Sudah Benar ?',
    //             type: 'warning',
    //             showCancelButton: true,
    //             confirmButtonColor: '#5cb85c',
    //             cancelButtonColor: '#d33',
    //             confirmButtonText: 'Ya',
    //             cancelButtonText: 'Batal',
    //             allowOutsideClick: false,
    //         }).then((result) => {
    //             if (result.value) {
    //                 form.submit();
    //             } else {
    //                 Swal.fire({
    //                     title: "Batal Ubah Data",
    //                     type: "error",
    //                     allowOutsideClick: false,
    //                 })
    //                 // refresh();
    //             }
    //         })
    //     } else {
    //         Swal.fire({
    //             text: " Harap Pilih Produk",
    //             icon: "error",
    //             buttonsStyling: false,
    //             confirmButtonText: "Ok, got it!",
    //             allowOutsideClick: false,
    //             customClass: {
    //                 confirmButton: "btn font-weight-bold btn-light"
    //             }
    //         });
    //     }

    // }
</script>
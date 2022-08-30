<form class="form" action="{{route('traders.pemasaran_bb.store')}}" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
    {{csrf_field()}}
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">No Transaksi:</label>
                    <div class="col-lg-8">
                        <input type="text" name="no_transaksi" class="form-control form-controller-solid" required placeholder="Nomor Transaksi" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Tanggal Transaksi:</label>
                    <div class="col-lg-8">
                        <div class="input-group date">
                            <input type="text" name="tgl_transaksi" required class="form-control form-controller-solid" placeholder="Tanggal Pemasaran" id="tgl_transaksi">
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
                        <select class="form-control form-controller-solid" required name="jenis_pemasaran" id="kt_select2">
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
                        <input type="text" name="pelabuhan_muat" required class="form-control form-controller-solid" placeholder="Pelabuhan Muat" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Lokasi Pelabuhan Muat</label>
                    <div class="col-lg-8">
                        <?php $prov = get_provinsi_data(); ?>
                        <select class="form-control form-controller-solid" required name="lokasi_pelabuhan_muat" id="kt_select1">
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
                        <input type="text" name="pelabuhan_ts" required class="form-control form-controller-solid" placeholder="Pelabuhan Tujuan" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nama Kapal:</label>
                    <div class="col-lg-8">
                        <input type="text" name="nama_kapal" required class="form-control form-controller-solid" placeholder="Nama Kapal" />
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
                        <select class="form-control form-controller-solid" required name="jenis_penjualan" id="kt_select3">
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
                        <select class="form-control form-controller-solid" required name="kategori_pembeli" id="akategori_pembeli">
                            <option selected disabled>-Pilih-</option>
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
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Negara Tujuan:</label>
                    <div class="col-lg-8">
                        <select class="form-control form-controller-solid" required name="negara_tujuan" id="kt_select4">
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
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
            <h3>Sumber Batubara</h3>
                @foreach($cek_inven as $in)
                <div class="form-group row">
                   
                    <label class="col-lg-4 col-form-label">
                        {{(get_nama_trader($in->id_perusahaan_kerjasama) == '-') ? get_nama_perusahaan_moms($in->id_perusahaan_kerjasama) : get_nama_trader($in->id_perusahaan_kerjasama) }}
                    </label>
                    <div class="col-lg-4">
                        <input type="hidden" name="id_perusahaan_kerjasama[]" class="form-control form-controller-solid" value="{{$in->id_perusahaan_kerjasama}}" />
                        <?php
                        $jenis = '';
                        if (get_nama_trader($in->id_perusahaan_kerjasama) == '-') {
                            if (get_nama_master_pembeli_moms($in->id_perusahaan_kerjasama) != '-') {
                                $jenis = 'IUP OPK Pengangkutan / Penjualan';
                            } elseif (get_nama_master_pembeli_moms($in->id_perusahaan_kerjasama) == '-') {
                                $jenis = 'IUP OP/ PKB2B / IUPK';
                            } else {
                                $jenis = '';
                            }
                        } else {
                            $jenis = 'IUP OPK Pengangkutan / Penjualan';
                        }
                        ?>
                        <input type="hidden" name="jenis_perusahaan[]" class="form-control form-controller-solid" value="{{$jenis}}" />
                        <input type="text" readonly name="volume_awal[]" class="form-control form-controller-solid" value="{{number_format($in->volume,4,',','.')}}" />
                        <span><small>Inventori</small></span>
                    </div>
                    <div class="col-lg-4">
                        <input type="text" name="volume_input[]" onchange="galebih('{{number_format($in->volume,4,'.',',')}}',this.value)" class="form-control volume_input volume" placeholder="Volume" />
                        <span><small>Volume Realisasi</small></span>
                    </div>
                </div>
                @endforeach
                <hr />
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">
                        Total Volume :
                    </label>
                    <div class="col-lg-8">
                        <input type="text" required id="total_volume" name="total_volume" readonly class="form-control form-controller-solid" placeholder="Volume" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">
                        Nilai Invoice :
                    </label>
                    <div class="col-lg-8">
                        <input type="text" id="nilai_invoice" required name="nilai_invoice" class="form-control form-controller-solid uang" placeholder="Nilai Invoice" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">
                        Harga Jual :
                    </label>
                    <div class="col-lg-8">
                        <input type="text" id="harga_jual" required name="harga_jual" class="form-control form-controller-solid uang" placeholder="Harga Jual" />
                    </div>
                </div>
            </div>
        </div>

        <hr />
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
                        <select class="form-control form-controller-solid" id="surveyor" name="surveyor">
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
    </div>
    <div class="card-footer d-flex justify-content-between">
        &nbsp;&nbsp;
        <div class="row">
            <button type="button" class="btn btn-success" onclick="confirm()">Simpan</button> &nbsp;&nbsp;&nbsp;&nbsp;
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
    $('.volume').inputmask({
        alias: "decimal",
        digits: 4,
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

    $('.uang').inputmask({
        alias: "decimal",
        digits: 2,
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
    $('#kt_select5').select2({
        placeholder: "- Pembeli -",
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
        $('#kt_select3').on('change', function(e) {
            var values = this.value;
            if (values == '6a79dcd6-1eb1-4a6c-95b9-b61480b2b934') {
                $("#kt_select4").empty().trigger('change');
                $.ajax({
                    url: "{{route('traders.pemasaran.negara_ekspor')}}",
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
                            var newOption = new Option(data[index].negara, data[index].id_negara, false, false);
                            // console.log(data[index].nama);
                            $('#kt_select4').append(newOption).trigger('change');
                        }
                    },
                    error: function(data) {
                        // console.log("gagal load data");
                        clear();
                    }
                });
            } else {
                $("#kt_select4").empty().trigger('change');
                $.ajax({
                    url: "{{route('traders.pemasaran.negara_domestik')}}",
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
                            var newOption = new Option(data[index].negara, data[index].id_negara, false, false);
                            // console.log(data[index].nama);
                            $('#kt_select4').append(newOption).trigger('change');
                        }
                    },
                    error: function(data) {
                        // console.log("gagal load data");
                        clear();
                    }
                });
            }
        });
        $(".volume").on("focusout keyup", function() {

        });
        $('#akategori_pembeli').on('change', function(e) {

            var values = this.value;

            if (values == '1') {
                $("#kt_select5").empty().trigger('change');

                $.ajax({
                    url: "{{route('traders.pemasaran.perusahaan_trader')}}",

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
        $(".volume").on("focusout keyup", function() {
            haha();
        });
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

    function galebih(batas, nilai) {
        batas1 = batas.split(',').join('');
        nilais = nilai.split('.').join('');
        nilais2 = nilais.split(',').join('.');
        if (parseFloat(nilais2) > parseFloat(batas1)) {
            Swal.fire({
                text: nilai + " Melebihi dari volume inventori",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                allowOutsideClick: false,
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light"
                }
            });
        } else {}
    }

    function haha() {
        var sum = 0;
        $(".volume_input").each(function() {
            var value = $.trim($(this).val());
            var tmpNilai = value.split('.').join('');
            var nilai = tmpNilai.split(',').join('.');

            if (nilai) {
                val = parseFloat(nilai.replace(/^\$/, ""));
                sum += !isNaN(val) ? val : 0;
            }
        });
        $('#total_volume').val(numberFormat(sum, 4, ',', '.'));
    }
    function confirm() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'Apakah Data yang di Masukan Sudah Benar ?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#5cb85c',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.value) {
                form.submit();
            } else {
                Swal.fire({
                    title: "Batal Ubah Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                // refresh();
            }
        }) 
    }
</script>
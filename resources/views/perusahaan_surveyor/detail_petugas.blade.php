@foreach($petugas as $ptgs)
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Nama Petugas:</label>
                <div class="col-lg-8 col-form-label font-weight-bold">
                    {{$ptgs->name}}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Nomor Sertifikat:</label>
                <div class="col-lg-8 col-form-label">
                    <!-- <input type="text" required name="no_sertifikat" class="form-control form-controller-solid" required placeholder="Nomor Sertifikat" /> -->
                    {{$ptgs->no_sertifikat}}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Email:</label>
                <div class="col-lg-8 col-form-label font-weight-bold">
                    {{$ptgs->email}}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Kata Sandi:</label>
                <div class="col-lg-8 col-form-label">
                    <div class="input-group">
                        <input type="password" autocomplete="new-password" readonly value="{{$ptgs->password_real}}" class="form-control form-control form-control-lg" value="" id="tab2_password" placeholder="Kata Sandi" />
                        <div class="input-group-append">
                            <button class="btn btn-secondary" type="button" onclick="myFunction()"><i class="fa fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Komoditi:</label>
                <div class="col-lg-8 col-form-label font-weight-bold">
                    @if($ptgs->batubara == true && $ptgs->mineral == true)
                    BATUBARA & mineral
                    @elseif($ptgs->batubara == true && $ptgs->mineral == null)
                    BATUBARA
                    @elseif($ptgs->batubara == null && $ptgs->mineral == true)
                    MINERAL
                    @else
                    -
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Lokasi Kerja Utama:</label>
                <div class="col-lg-8 col-form-label font-weight-bold">
                    {{($ptgs->nama_provinsi_satu)?$ptgs->nama_provinsi_satu : '-'}}
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Lokasi Kerja Kedua:</label>
                <div class="col-lg-8 col-form-label font-weight-bold">
                    {{($ptgs->nama_provinsi_dua)?$ptgs->nama_provinsi_dua : '-'}}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <?php
            $dokumen_url = asset('Upload_Dokumen/' . $ptgs->file);
            ?>
            <span><small>Dokumen Surat Rekomendasi</small></span>
            <br />
            <embed id="preview2" width="100%" height="600px" />
        </div>
    </div>
</div>
@endforeach


<script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.6')}}"></script>
<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script>
    $(document).ready(function() {
        var file2 = '{{$dokumen_url}}';
        var x = 'https://drive.google.com/viewerng/viewer?embedded=true&url=';
        $('#preview2').attr('src', x + file2);
    });

    function myFunction() {
        var x = $("#tab2_password").val();
        var allInputs = $("#tab2_password");
        if (allInputs.attr('type') == 'text') {
            $('#tab2_password').attr('type', 'password');
        } else if (allInputs.attr('type') == 'password') {
            $('#tab2_password').attr('type', 'text');
        } else {
            $('#tab2_password').attr('type', 'password');
        }

    }

    function hide_add() {
        $('.body-content').remove();
        $('#body_modal_detail').html('<div class="body-content"></div>')
    }



    $('#kt_select2').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });
    $('#kt_select1').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });

    $('#komoditas').select2({
        placeholder: "- Pilih Komoditas -",
        allowClear: true,
    });

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
                    title: "Batal Simpan Data",
                    type: "error",
                    allowOutsideClick: false,
                })
                // refresh();
            }
        })
    }
</script>
<form class="form" action="{{route('surveyors.petugas.update')}}" class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
    {{csrf_field()}}
    @foreach($petugas as $ptgs)
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nama Petugas:</label>
                    <div class="col-lg-8">
                        <input type="hidden" value="{{$ptgs->uuid}}" required name="id_petugas" class="form-control form-controller-solid" placeholder="Nama Petugas" />
                        <input type="text" value="{{$ptgs->name}}" required name="nama_petugas" class="form-control form-controller-solid" placeholder="Nama Petugas" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nomor Sertifikat:</label>
                    <div class="col-lg-8">
                        <input type="text" value="{{$ptgs->no_sertifikat}}" required name="no_sertifikat" class="form-control form-controller-solid" placeholder="Nomor Sertifikat" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Email:</label>
                    <div class="col-lg-8">
                        <input type="email" value="{{$ptgs->email}}" required name="email" class="form-control form-controller-solid" placeholder="Email" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Kata Sandi:</label>
                    <div class="col-lg-8">
                        <input type="password" value="{{$ptgs->password_real}}" required name="password" class="form-control form-controller-solid" placeholder="Kata Sandi" />
                    </div>
                </div>
                <?php 
                    $selected_komoditas = '';
                    $provinsi1 = $ptgs->provinsi_satu;
                    $provinsi2 = $ptgs->provinsi_dua;
                ?>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Komoditi:</label>
                    <div class="col-lg-8">
                        <select class="form-control form-controller-solid" required name="komoditas" id="komoditas">
                            <option></option>
                            <option value="1">BATUBARA</option>
                            <option value="2">MINERAL</option>
                            <option value="3">BATUBARA &amp; MINERAL</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Lokasi Kerja Utama:</label>
                    <div class="col-lg-8">
                        <?php $provinsi = get_provinsi_data(); ?>
                        <select class="form-control form-controller-solid" required name="provinsi1" id="kt_select1">
                            <option></option>
                            @foreach($provinsi as $p)
                            <option value="{{$p->id_provinsi}}">{{$p->nama_provinsi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Lokasi Kerja Kedua:</label>
                    <div class="col-lg-8">
                        <select class="form-control form-controller-solid" name="provinsi2" id="kt_select2">
                            <option></option>
                            @foreach($provinsi as $p)
                            <option value="{{$p->id_provinsi}}">{{$p->nama_provinsi}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Dokumen Surat Rekomendasi:</label>
                    <div class="col-lg-8">
                        <div class="custom-file">
                            <input type="file" required class="custom-file-input" name="customFile" accept=".pdf" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                        <span class="text-muted"><small>Dokumen lama : <a target="download" href="{{asset('Upload_Dokumen/' . $ptgs->file)}}">Klik Disini !</a></small></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
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
    @if(!empty($provinsi2))
    $('#kt_select2').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });
    $('#kt_select2').val('{{$provinsi2}}').trigger('change');
    @else
    $('#kt_select2').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });
    @endif

    @if(!empty($provinsi1))
    $('#kt_select1').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });
    $('#kt_select1').val('{{$provinsi1}}').trigger('change');
    @else
    $('#kt_select1').select2({
        placeholder: "- Pilih Provinsi -",
        allowClear: true,
    });
    @endif

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
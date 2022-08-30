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
                <div class="col-xl-12">
                    <div class="card card-custom gutter-b" id="kt_card_3">
                        <div class="card-header bg-color-navy">
                            <div class="card-title">
                                <h3 class="card-label text-white">
                                    {{$judul}}
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{$url_back}}" title="Kembali" class="btn btn-light-danger mr-2">
                                    <i class="fas fa-angle-double-left"></i> &nbsp;&nbsp; Kembali
                                </a>
                            </div>
                        </div>
                        <form class="form-horizontal" method="post" action="{{route('surveyors.store_dokumen_lhv.bb')}}" enctype="multipart/form-data" role="form">
                            <div class="card-body" style="background-color: whitesmoke;">
                                {{csrf_field()}}
                                <input type="hidden" name="lhv_id_pemasaran[]" value="{{$id_pemasaran}}">
                                <div class="row">
                                    @foreach($tongkang as $tkg)
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Nama Tongkang (Tug Boat):</label>
                                            <div class="col-lg-8">
                                                <label class="font-weight-boldest col-form-label"><b>{{$tkg->nama_tongkang}} ({{$tkg->tag_boat}})</b></label>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$tkg->id_detail}}" name="id_detail[]" class="form-control form-controller-solid" />
                                        <input type="hidden" value="{{$tkg->no_lhv}}" name="no_lhv[]" class="form-control form-controller-solid" />
                                        @if($tkg->no_lhv == 'DITOLAK')
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label"></label>
                                            <div class="col-lg-8">
                                            <input type="file" style="display: none;" class="custom-file-input" name="doc_lhv[]" accept=".pdf" id="customFile">
                                                <label class="font-weight-boldest col-form-label"><span class="text-danger font-weight-boldest">Pengajuan Ditolak</span></label>
                                            </div>
                                        </div>
                                        @elseif(empty($tkg->dokumen_lhv) && empty($tkg->no_lhv))
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label"></label>
                                            <div class="col-lg-8">
                                                <input type="file" style="display: none;" class="custom-file-input" name="doc_lhv[]" accept=".pdf" id="customFile">
                                                <label class="font-weight-boldest col-form-label"><span class="text-warning font-weight-boldest">Belum Terverifikasi</span></label>
                                            </div>
                                        </div>
                                        @else
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Nomor LHV Tongkang:</label>
                                            <div class="col-lg-8">
                                                <label class="font-weight-boldest col-form-label">
                                                    <p class="font-weight-boldest">{{$tkg->no_lhv}}</p>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Dokumen Surat Rekomendasi:</label>
                                            <div class="col-lg-8">
                                                @if(empty($tkg->dokumen_lhv) && !empty($tkg->no_lhv))
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="doc_lhv[]" accept=".pdf" id="customFile">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                @else
                                                <span class="text-primary">Sudah Terupload</span>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    @endforeach
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                &nbsp;&nbsp;
                                <div class="row">
                                    <button type="button" onclick="confirm()" class="btn btn-success">Simpan</button> &nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
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

@endsection
@section('javascript')

<script>
    $(function() {
        @if(session('msg'))
        Swal.fire("{{Session::get('msg')}}", '', 'success');
        @endif
        @if($errors->any())
        var error = "{{$errors->first()}}";
        Swal.fire(error, '', 'error');
        @endif
    });
</script>
<script>
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
@endsection
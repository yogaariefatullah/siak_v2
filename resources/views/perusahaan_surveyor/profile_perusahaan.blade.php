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
                                    Profile Verifikator
                                </h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-primary mr-1" data-card-tool="toggle">
                                    <i class="ki ki-arrow-down icon-nm"></i>
                                </a>
                                <a href="#" class="btn btn-icon btn-circle btn-sm btn-light-success mr-1" data-card-tool="reload">
                                    <i class="ki ki-reload icon-nm"></i>
                                </a>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: whitesmoke;">
                            <div class="row">
                                <div class="col-md-12">
                                    @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade in" id="error-alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div><br />
                                    @endif
                                    @if(session('msg'))
                                    <div class="alert alert-success alert-dismissable" id="success-alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Berhasil!</strong>&nbsp;{{session('msg')}}
                                    </div>
                                    @elseif(session('error'))
                                    <div class="alert alert-danger alert-dismissable" id="danger-alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <strong>Gagal!</strong>&nbsp;{{session('error')}}
                                    </div>
                                    @endif
                                    <form class="form-horizontal" action="{{route('surveyors.updateProfile')}}" method="post" enctype="multipart/form-data" role="form">
                                        {{csrf_field()}}
                                        <div class="form-group row">
                                            <input type="hidden" name="id_profile" value="{{isset($result->id_profile)?$result->id_profile:''}}">
                                            <label for="input01" class="col-sm-3 control-label">Logo Perusahaan</label>
                                            <div class="col-sm-8">
                                                @if(!empty($result->file))
                                                <div class="row" id="show-img">
                                                    <div class="col-md-6">
                                                        <img src="{{url('/logo_surveyor/'.$result->file)}}" width="150px" height="150px">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a onclick="return show()" id="btn-upload-ulang" class="btn btn-sm btn-success"><i class="fa fa-upload"></i>&nbsp;Unggah ulang</a>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="input-group">
                                                            <span class="input-group-btn">
                                                                <span class="btn btn-primary btn-file">
                                                                    <i class="fa fa-upload"></i><input type="file" id="file1" name="file1" multiple="">
                                                                </span>
                                                            </span>
                                                            <input type="text" id="nama_file" class="form-control" readonly="">
                                                        </div>
                                                        <span class="text-muted"><small>*(jpg/png,maks. 1MB,maks. 300x300px)</small></span>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row" id="upload-ulang" style="display:none;">
                                            <label class="col-lg-3 col-form-label">Dokumen Surat Rekomendasi:</label>
                                            <div class="col-lg-8">
                                                <div class="custom-file">
                                                    <input type="file" required class="custom-file-input" name="file" accept=".pdf" id="file" required>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <span class="text-muted"><small>*(jpg/png,maks. 1MB,maks. 300x300px)</small></span>
                                                <br />
                                                <a onclick="return back()" id="upload-cancel" class="btn btn-sm btn-danger"><i class="fa fa-times"></i>&nbsp;Batal</a>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-8">
                                                <span class="badge badge-redbrown" id="errorSize" style="padding:10px;float:left;display:none;"><i class="fa fa-warning"></i>&nbsp;Ukuran file melebihi 1 MB</span>
                                                <span class="badge badge-redbrown" id="detailSize" style="padding:10px;float:left;display:none;"><i class="fa fa-warning"></i>&nbsp;Ukuran pixel tidak sesuai</span>

                                                <span class="badge badge-redbrown" id="errorType" style="padding:10px;float:left;display:none;"><i class="fa fa-warning"></i>&nbsp;Type file harus image format
                                                    jpg|png</span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="input01" class="col-sm-3 control-label">Alamat</label>
                                            <div class="col-sm-8">
                                                <?php if (!empty($result->alamat)) {
                                                    $alamat =  $result->alamat;
                                                }
                                                ?>
                                                <textarea name="alamat" maxlength="175" class="form-control">{{($result->alamat)? $result->alamat : ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group form-footer">
                                            <div class="col-sm-offset-5 col-md-10">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="reset" class="btn btn-danger">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

@endsection
@section('javascript')
<script>
    function show() {
        $('#upload-ulang').show();
        $('#show-img').hide();
    }

    function back() {
        $('#upload-ulang').hide();
        document.getElementById('file').value = "";
        // document.getElementById('nama_file').value = "";
        $('#show-img').show();
    }
    $(document).ready(function() {
        $('#file1').on('change', function() {
            var file, img;
            var dataFile = document.getElementById('file1');
            var fileType = document.querySelector('#file1');
            document.getElementById('nama_file').value = dataFile.files.item(0).name;
            var size = Math.round(this.files[0].size / 1024);
            //alert(size);

            if (/\.(jpg|png)$/i.test(fileType.files[0].name) === false) {
                $('#errorType').show().delay(3000).hide('slow');
            }
            if (size > 1024) {
                //cek size file berapa kb
                $('#errorSize').show().delay(3000).hide('slow');
                //alert('sss');
            } else {
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onload = function() {
                        //cek ukuran width & height file
                        if (this.width > 300 || this.height > 300) {
                            $('#detailSize').show().delay(3000).hide('slow');
                        }
                    };
                    img.src = _URL.createObjectURL(file);
                }
            }
        });
        $('#file').on('change', function() {
            var file, img;
            var dataFile = document.getElementById('file');
            var fileType = document.querySelector('#file');
            document.getElementById('nama_file').value = dataFile.files.item(0).name;
            var size = Math.round(this.files[0].size / 1024);
            //alert(size);
            if (/\.(jpg|png)$/i.test(fileType.files[0].name) === false) {
                $('#errorType').show().delay(3000).hide('slow');
            }
            if (size > 1024) {
                //cek size file berapa kb
                $('#errorSize').show().delay(3000).hide('slow');
                //alert('sss');
            } else {
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onload = function() {
                        //cek ukuran width & height file
                        if (this.width > 300 || this.height > 300) {
                            $('#detailSize').show().delay(3000).hide('slow');
                        }
                    };
                    img.src = _URL.createObjectURL(file);
                }
            }
        });
    });
</script>
<script>
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_3');

    // Toggle event handlers
    card.on('beforeCollapse', function(card) {
        setTimeout(function() {
            // toastr.info('Before collapse event fired!');
        }, 100);
    });

    card.on('afterCollapse', function(card) {
        setTimeout(function() {
            // toastr.warning('Before collapse event fired!');
        }, 2000);
    });

    card.on('beforeExpand', function(card) {
        setTimeout(function() {
            // toastr.info('Before expand event fired!');
        }, 100);
    });

    card.on('afterExpand', function(card) {
        setTimeout(function() {
            // toastr.warning('After expand event fired!');
        }, 2000);
    });
    card.on('reload', function(card) {
        // toastr.info('Leload event fired!');

        KTApp.block(card.getSelf(), {
            overlayColor: '#ffffff',
            type: 'loader',
            state: 'primary',
            opacity: 0.3,
            size: 'lg'
        });
        setTimeout(function() {
            KTApp.unblock(card.getSelf());
        }, 2000);
    });
</script>
@endsection
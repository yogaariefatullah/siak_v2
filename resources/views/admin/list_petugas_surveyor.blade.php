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
                        PETUGAS VERIFIKATOR SURVEYOR      
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
                        LIST PETUGAS
                        <span class="d-block text-muted pt-2 font-size-sm">VERIFIKATOR SURVEYOR</span>
                    </h3>
                </div>
            </div>
            <div class="card-body">
                <!--Table-->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_tab_pane_4_1" role="tabpanel" aria-labelledby="kt_tab_pane_4_1">
                        <div class="col-xl-12">
                                <div class="table-responsive">
                                        <table class="table table-datatable table-custom" id="users-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <center>ID</center>
                                                    </th>
                                                    <th>
                                                        <center>Nama</center>
                                                    </th>
                                                    <th>
                                                        <center>Provinsi Bertugas</center>
                                                    </th>
                                                    <th>
                                                        <center>Status</center>
                                                    </th>
                                                    <th>
                                                        <center>Perusahaan Surveyor</center>
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
        <!--end::Card-->


        </div>
        <!--end::Container-->

    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->


{{-- MODAL --}}
<div class="modal fade" id="modalConfirmedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background: #3445E5">
                    <h2 class="modal-title" style="color: whitesmoke;"><strong>EDIT</strong> PETUGAS SURVEYOR</h2>
                </div>
                <form method="POST" id="register-formedit" action="{{ route('admin.updatepetugassurveyor') }}"
                    role="form">
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="exampleInput">Nama Petugas</label>
                            <input id="uuid" type="hidden" class="form-control" name="uuid">
                            <input id="status" type="hidden" class="form-control" name="status">
                            <input id="namaperusahaan" type="text" class="form-control" name="nama">
                        </div>

                        <div class="form-group">
                            <label for="exampleInput">Email Petugas</label>
                            <input id="emailperusahaan" type="text" class="form-control" name="email">
                        </div>

                        <div class="form-group">
                            <label for="passwordInput">Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password_real">Password</label>
                            <input id="password_real" readonly="" type="text" class="form-control" name="password_real">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Kembali</button>
                        <button style="background-color: rgb(77, 142, 192);color:white;" class="btn btn">
                            Simpan</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal_alasan" role="dialog" aria-labelledby="exampleModalSize" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="myModalLabel" style="color: whitesmoke;"></h2>
                </div>
                <div class="modal-body">
                    <form id="tolakperusahaan-form" action="{{url('admin/active_disactive_petugas')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label id="exampleInput"></label>
                            <input type="hidden" id="txtIDperusahaan" name="txtIDperusahaan">
                            <input type="hidden" id="kat" name="kat">
                            <textarea class="form-control" id="alasan" name="alasan" placeholder="Masukan Alasan"
                                required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Kembali
                    </button>
                    <a id="btn_tolak" onclick="form_submittolak()"
                        style="background-color: #3445E5;color:white; display: none" class="btn btn"> Simpan
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
</div>



@endsection
@section('javascript')
<script>

    $( document ).ready(function() {
        $('.menu-item-active'). removeClass('menu-item-active');
        $('#surveyorpetu'). addClass('menu-item-active');

    });
</script>
<script>
    $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.getanylistverifikator') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'provinsi', name: 'provinsi'},
                    {data: 'aktifasi', name: 'aktifasi',width: '80px'},
                    {data: 'id_perusahaan_surveyor', name: 'id_perusahaan_surveyor'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
    });

    function editps(uuid) {

        var url = "{{url('admin/editperusahaansurveyor')}}/" + uuid + "";
        $('#modalConfirmedit').modal('show');
        $.get(url, function(data) {

            $('#namaperusahaan').val(data[0].name)
            $('#emailperusahaan').val(data[0].email)
            $('#password').val(data[0].password_real)
            $('#uuid').val(data[0].uuid)
            $('#password_real').val(data[0].password_real)

        });

    }

    function alasan(id,kat,nama) {
        $('#modal_alasan').modal('show');
        $('#txtIDperusahaan').val(id);
        $('#kat').val(kat);
        if(kat == 1){
            $('#myModalLabel').text('ALASAN TERIMA / AKTIF PETUGAS SURVEYOR');
            $('.modal-header').css('background','#3445E5');
        }else{
            $('#myModalLabel').text('ALASAN TOLAK / NON-AKTIF PETUGAS SURVEYOR');
            $('.modal-header').css('background','#F64E60');
        }
        $('#exampleInput').text(nama);
    }
    function form_submittolak() {
        document.getElementById("tolakperusahaan-form").submit();
    }
    $('#alasan').bind('input propertychange', function() {
        if (this.value != '')
            $('#btn_tolak').show();
        else if (this.value == '')
            $('#btn_tolak').hide();
    });

</script>
<script>
</script>
@endsection
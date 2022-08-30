<div id="kt_header_menu" class="header-menu header-menu-left header-menu-mobile  header-menu-layout-default ">
    <!--begin::Header Nav-->
    <ul class="menu-nav">
        @if(Auth::guard('traders')->check())
        @if(Auth::guard('traders')->user()->jenis_komoditas == '1b5f47a9-e6c9-46e2-b957-c113ef39c787')
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.dashboard.bb')}}" class="menu-link "><i class="fas fa-home"></i><span class="menu-text">&nbsp;&nbsp;DASHBOARD</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.list_sk.bb')}}" class="menu-link "><span class="menu-text"> SK INDUK</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.verifikasi_pembelian.bb')}}" class="menu-link "><span class="menu-text"> VERIFIKASI PEMBELIAN</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.pembelian.bb')}}" class="menu-link "><span class="menu-text"> REALISASI PEMBELIAN</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.pemasaran.bb')}}" class="menu-link "><span class="menu-text"> REALISASI PEMASARAN</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.rekapitulasi.bb')}}" class="menu-link "><span class="menu-text"> REKAPITULASI PEMBELIAN & PEMASARAN</span></a></li>
        @else
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.dashboard.mn')}}" class="menu-link "><i class="fas fa-home"></i><span class="menu-text">&nbsp;&nbsp;DASHBOARD</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.list_sk.mn')}}" class="menu-link "><span class="menu-text"> SK INDUK</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.verifikasi_pembelian.mn')}}" class="menu-link "><span class="menu-text"> VERIFIKASI PEMBELIAN</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.pembelian.mn')}}" class="menu-link "><span class="menu-text"> REALISASI PEMBELIAN</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('traders.pemasaran.mn')}}" class="menu-link "><span class="menu-text"> REALISASI PEMASARAN</span></a></li>
        @endif

        @elseif(Auth::guard('surveyors')->check())
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('surveyors.dashboard.surveyors')}}" class="menu-link "><i class="fas fa-home"></i><span class="menu-text">&nbsp;&nbsp;DASHBOARD</span></a></li>
        @if(empty(Auth::guard('surveyors')->user()->id_perusahaan_surveyor))
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('surveyors.petugas.index')}}" class="menu-link "><i class="far fa-user-circle"></i><span class="menu-text">&nbsp;&nbsp;Petugas Verifikator</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('surveyors.profile')}}" class="menu-link "><i class="far fa-building"></i><span class="menu-text">&nbsp;&nbsp;Profile Perusahaan</span></a></li>

        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('surveyors.index_muat_bb',['jenis_pembeli'=>5])}}}" class="menu-link "><i class="fas fa-warehouse"></i><span class="menu-text">&nbsp;&nbsp;Verifikasi ISP</span></a></li>
        <li class="menu-item menu-item" aria-haspopup="true"><a href="{{route('surveyors.index_trader')}}" class="menu-link "><i class="fas fa-file-contract"></i><span class="menu-text">&nbsp;&nbsp;Verifikasi LHV IUP OPK</span></a></li>

        @if(Auth::guard('surveyors')->user()->batubara == true)
        <li class="menu-item  menu-item-submenu" data-menu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="menu-link menu-toggle"><i class="fas fa-trailer"></i><span class="menu-text">&nbsp;&nbsp;BATUBARA</span><span class="menu-desc"></span><i class="menu-arrow"></i></a>
            <div class="menu-submenu  menu-submenu-fixed menu-submenu-center" style="width:95%">
                <div class="menu-subnav">
                    <ul class="menu-content">
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Muat</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_muat_bb',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_muat_bb',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_muat_bb',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Serah</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_tiser_bb',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_tiser_bb',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_tiser_bb',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        @endif

        @if(Auth::guard('surveyors')->user()->mineral == true)
        <li class="menu-item  menu-item-submenu" data-menu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="menu-link menu-toggle"><i class="far fa-gem"></i><span class="menu-text">&nbsp;&nbsp;MINERAL</span><span class="menu-desc"></span><i class="menu-arrow"></i></a>
            <div class="menu-submenu  menu-submenu-fixed menu-submenu-center" style="width:95%">
                <div class="menu-subnav">
                    <ul class="menu-content">
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Muat</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_muat_mn',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_muat_mn',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.index_muat_mn',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Serah</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.index_tiser_mn',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.index_tiser_mn',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.index_tiser_mn',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        @endif
        @else
        <!-- VERIFIKATOR -->
        @if(Auth::guard('surveyors')->user()->batubara == true)
        <li class="menu-item  menu-item-submenu" data-menu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="menu-link menu-toggle"><i class="fas fa-trailer"></i><span class="menu-text">&nbsp;&nbsp;VERIFIKASI KOMODITAS BATUBARA</span><span class="menu-desc"></span><i class="menu-arrow"></i></a>
            <div class="menu-submenu  menu-submenu-fixed menu-submenu-center" style="width:95% ">
                <div class="menu-subnav">
                    <ul class="menu-content">
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi ISP</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_bb',['jenis_pembeli'=>5])}}" class="menu-link ">
                                        <i class="fas fa-warehouse"></i><span class="menu-text">&nbsp;&nbsp;Verifikasi ISP</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi LHV IUP OPK Batubara</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_trader')}}" class="menu-link ">
                                        <i class="fas fa-file-contract"></i><span class="menu-text">&nbsp;&nbsp;Verifikasi LHV IUP OPK </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Muat Batubara</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_bb',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_bb',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_bb',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Serah Batubara</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_tiser_bb',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_tiser_bb',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_tiser_bb',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Produksi</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_produksi_bb')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">Verifikasi Produksi Penambangan Batubara</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        @endif

        @if(Auth::guard('surveyors')->user()->mineral == true)
        <li class="menu-item  menu-item-submenu" data-menu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="menu-link menu-toggle"><i class="far fa-gem"></i><span class="menu-text">&nbsp;&nbsp;VERIFIKASI KOMODITAS MINERAL</span><span class="menu-desc"></span><i class="menu-arrow"></i></a>
            <div class="menu-submenu  menu-submenu-fixed menu-submenu-center" style="width:95%">
                <div class="menu-subnav">
                    <ul class="menu-content">
                        <!-- <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi LHV IUP OPK Mineral</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_trader')}}" class="menu-link ">
                                        <i class="fas fa-file-contract"></i><span class="menu-text">&nbsp;&nbsp;Verifikasi LHV IUP OPK </span>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Muat Mineral</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_mn',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_mn',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_muat_mn',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Titik Serah Mineral</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_tiser_mn',['jenis_pembeli'=>2])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">ENDUSER</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_tiser_mn',['jenis_pembeli'=>1])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OPK Angkut / Jual</span>
                                    </a>
                                </li>
                                <li class="menu-item " aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_tiser_mn',['jenis_pembeli'=>3])}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">IUP OP / PKP2B / IUP K</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item ">
                            <h3 class="menu-heading menu-toggle"><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text">Verifikasi Produksi</span><i class="menu-arrow"></i></h3>
                            <ul class="menu-inner">
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{route('surveyors.petugas.index_produksi_mn')}}" class="menu-link "><i class="menu-bullet menu-bullet-line"><span></span></i>
                                        <span class="menu-text">Verifikasi Produksi Penambangan Mineral</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </li>
        @endif
        <!-- VERIFIKATOR -->
        @endif
        @elseif(Auth::guard('surveyors_perusahaan')->check())

        @elseif(Auth::guard('adminstrator')->check())
        <li class="menu-item" aria-haspopup="true" id="dashboardmenu"><a href="{{route('admin.index')}}" class="menu-link"><span class="menu-text">DASHBOARD</span></a></li>
        <li class="menu-item" aria-haspopup="true" id="iupopaj"><a href="{{route('admin.registrasi_treader')}}" class="menu-link"><span class="menu-text">IUP OP AJ</span></a></li>
        <li class="menu-item" aria-haspopup="true" id="listsk"><a href="{{route('admin.listSK')}}" class="menu-link"><span class="menu-text">LIST SK</span></a></li>
        <li class="menu-item" aria-haspopup="true" id="surveyorperu"><a href="{{route('admin.listps')}}" class="menu-link"><span class="menu-text">SURVEYOR</span></a></li>
        <li class="menu-item" aria-haspopup="true" id="surveyorpetu"><a href="{{route('admin.listpetugas')}}" class="menu-link"><span class="menu-text">PETUGAS SURVEYOR</span></a></li>

        @else
        @endif

    </ul>
    <!--end::Header Nav-->
</div>
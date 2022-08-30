<form class="form-horizontal">
    @foreach($detail as $det)
    <div class="row">
        <div class="col-md-6">
            <table class="table table-borderless table-responsive-lg">
                <tr>
                    <th>Nomor SK</th>
                    <td>:</td>
                    <td>{{$det->no_sk}}</td>
                </tr>
                <tr>
                    <th>Status SK</th>
                    <td>:</td>
                    <td>
                        @if($det->status_aktif == 1 && $det->status_approve == 1)
                        <p class="text-primary">
                            <b>Sudah di Setujui Oleh Administrator</b>
                        </p>
                        @elseif($det->status_aktif == 1 && $det->status_approve == null)
                        <p class="text-warning">
                            <b> Belum di Setujui Oleh Administrator</b>
                        </p>
                        @elseif($det->status_aktif == 2 && $det->status_approve == 2)
                        <p class="text-danger">
                            <b> Ditolak</b>
                        </p>
                        @elseif($det->status_aktif == 2 && $det->status_approve == 1)
                        <p class="text-danger">
                            <b>SK Tidak Aktif</b>
                        </p>
                        @endif
                    </td>
                </tr>
            </table>

        </div>
        <div class="col-md-6">
            <table class="table table-borderless table-responsive-lg">
                <tr>
                    <th>Masa Berlaku</th>
                    <td>:</td>
                    <td>{{tgl_indo($det->tanggal_sk)}} S/d {{tgl_indo($det->masa_berlaku)}}</td>
                </tr>
                @if(!empty($det->alasan) && $det->status_approve == 2)
                <tr>
                    <th>Alasan</th>
                    <td>:</td>
                    <td>
                        <p style="text-align: justify;">{{$det->alasan}}</p>
                    </td>
                </tr>
                @endif
            </table>
        </div>
    </div>
    @php $sts_sk= $det->status_approve;@endphp
    @endforeach

    <div class="table-responsive">
        <table class="table table-light table-responsive-lg rounded">
            <thead class="thead-dark">
                <tr>
                    <td colspan="4">
                        <center>LIST DATA PERUSAHAAN</center>
                    </td>
                </tr>
                <tr>
                    <th>Nama Perusahaan</th>
                    <th>Volume</th>
                    <th>Jenis Perusahaan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($perusahaan as $per)
                <tr>
                    <td>{{ (get_nama_trader($per->id_perusahaan) == '-') ? get_nama_perusahaan_moms($per->id_perusahaan):get_nama_trader($per->id_perusahaan) }}</td>
                    <td>{{$per->volume}} Ton</td>
                    <td>{{$per->jenis_perusahaan}}</td>
                    <td>
                        @if ($det->status_approve == 1)
                        @if($per->status_approve == true)
                        Telah Disetujui
                        @else
                        Ditolak
                        @endif
                        @else
                        Belum Disetujui
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-light table-responsive-lg rounded">
            <thead class="thead-dark">
                <tr>
                    <td colspan="4">
                        <center>LIST DOKUMEN</center>
                    </td>
                </tr>
                <tr>
                    <th class="sort-alpha">Penambahan Ke-</th>
                    <th class="sort-alpha">Dokumen Lampiran</th>
                </tr>
            </thead>
            <tbody id="detailDokumen">
                @foreach($dok_lampiran as $dok)
                <tr>
                    <td>{{($dok->status_penambahan == 0) ? 'Awal' : $dok->status_penambahan}}</td>
                    <td><a class="btn btn-link-warning font-weight-bold" href="{{url('/Upload_Dokumen/'.$dok->dokumen)}}" target="_blank" rel="noopener noreferrer">{{$dok->dokumen}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</form>
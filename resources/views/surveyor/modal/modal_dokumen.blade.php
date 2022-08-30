@foreach($pemasaran as $item)
<div class="row">
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-lg">
            <tr>
                <th>Penjual</th>
                <td>:</td>
                <td>
                    {{get_nama_perusahaan_moms($item->pelapor)}}
                </td>
            </tr>
            <tr>
                <th>No.Transaksi</th>
                <td>:</td>
                <td>{{$item->id_transaksi}}</td>
            </tr>
            <tr>
                <th>No.NTPN</th>
                <td>:</td>
                <td>{{$item->no_ntpn}}</td>
            </tr>

        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-borderless table-responsive-lg">
            <tr>
                <th>
                    @if($item->kategori_pembeli == 2)
                    Nama Pembeli
                    @elseif($item->kategori_pembeli == 1)
                    Nama Pembeli
                    @elseif($item->kategori_pembeli == 5)
                    Stockpile
                    @else
                    -
                    @endif
                </th>
                <td>:</td>
                <td>
                    @if($item->kategori_pembeli == 2)
                    {{get_nama_master_pembeli_moms($item->id_masterpembeli)}}
                    @elseif($item->kategori_pembeli == 1)
                    {{get_nama_trader($item->id_masterpembeli)}}
                    @elseif($item->kategori_pembeli == 5)
                    {{get_nama_stockpile($item->id_masterpembeli)}}
                    @else
                    -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Kode Billing</th>
                <td>:</td>
                <td>{{$item->kode_billing}}</td>
            </tr>
            <tr>
                <th>Link Alternatif Dokumen</th>
                <td>:</td>
                <td>
                    <p><a target="_blank" rel="noopener noreferrer" href="{{$dok_buktibayar}}">Dokumen Bukti Bayar</a></p>
                    <p><a target="_blank" rel="noopener noreferrer" href="{{$dok_shipping}}">Dokumen Shipping</a></p>
                </td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label class="col-form-label">Dokumen Bukti Bayar:</label>
        <embed type="application/pdf" id="buktibayar" src="{{$dok_buktibayar}}" width="100%" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
        <!-- <embed id="preview" width="100%" height="400px" src="{{$dok_buktibayar}}" /> -->
    </div>
    <div class="col-md-6">
        <label class="col-form-label">Dokumen Shipping:</label>
        <embed type="application/pdf" id="shipping" src="{{$dok_shipping}}" width="100%" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" background-color="0xFF525659" top-toolbar-height="56" full-frame="" internalinstanceid="21" title="CHROME">
        <!-- <embed id="previews" width="100%" height="400px" src="{{$dok_shipping}}" /> -->
    </div>
</div>
<div class="separator separator-solid separator-border-3"></div>
<br />
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">
        @if (empty($item->status_buktibayar))
        <form id="btnVerif" action="{{route('surveyors.dokumen.bb.accept')}}" method="post">
            {{csrf_field()}}
            <button class="btn btn-success" title="Diterima">
                <i class="fa fa-check-circle"></i>&nbsp;Diterima
            </button>&nbsp;
            <input type="hidden" name="id_pemasaran" id="id_pemasaran" value="{{$item->id_pemasaran_bb}}">
            <button type="button" class="btn btn-danger" onclick="confirm()" title="Ditolak"><i class="fa fa-times"></i>&nbsp;Ditolak</button>
        </form>

        @endif
    </div>
</div>

@endforeach

<script>
    function confirm() {
        event.preventDefault(); // prevent form submit
        var form = event.target.form; // storing the form
        Swal.fire({
            title: 'Tolak Transaksi ',
            input: 'textarea',
            icon: "warning",
            inputPlaceholder: 'Alasan ditolak',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-times"></i>&nbsp;Tolak',
            confirmButtonColor: '#d33',
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "{{route('surveyors.dokumen.bb.reject')}}",
                    type: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        id_pemasaran: $('#id_pemasaran').val(),
                        alasan: result.value
                    },
                    beforeSend: function() {
                        $('#loader').show();
                    },
                    complete: function() {
                        $('#loader').hide();
                    },
                    success: function(data) {
                        Swal.fire('Transaksi ditolak', '', 'success');
                        console.log(data);
                        refresh();
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        })
    }
</script>
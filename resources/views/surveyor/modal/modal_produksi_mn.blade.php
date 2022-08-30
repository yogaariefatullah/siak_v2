<div class="row">
    <div class="col-md-12">
        <table class="table table-light table-responsive-lg rounded">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Nama Perusahaan
                    </th>
                    <th>
                        No Ref
                    </th>
                    <th>
                        Kontraktor
                    </th>
                    <th>
                        Volume Produksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>
                        {{$pelapor}}
                    </td>
                    <td>
                        {{$d->no_ref}}
                    </td>
                    <td>
                        {{$d->kontraktor}}
                    </td>
                    <td>
                        {{number_format($d->produksi,2,',','.')}} Ton
                        <?php $vol = $d->produksi; ?>
                    </td>
                    <input type="text" style="display: none;" class="form-control" autocomplete="off" name="id_produksi" id="id_produksi" value="{{$d->id_produksi_mn}}">
                    <input type="text" style="display: none;" class="form-control" autocomplete="off" name="id_perusahaan" id="id_perusahaan" value="{{$d->id_perusahaan}}">
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label for="input01" class="col-md-6 control-label" style="text-align: left !important;">Volume Verifikasi</label>
            <div class="col-md-6">
                <input type="text" class="form-control angka" autocomplete="off" name="volume" id="volume" value="{{number_format($vol,4,',','.')}}">
            </div>
        </div>
    </div>
</div>

<script>
    function inputMask() {
        $('.angka').inputmask({
            alias: "numeric",
            digits: 4,
            repeat: 15,
            digitsOptional: false,
            decimalProtect: true,
            groupSeparator: ".",
            placeholder: '0',
            radixPoint: ",",
            radixFocus: true,
            autoGroup: true,
            autoUnmask: false,
            clearMaskOnLostFocus: false,
            onUnMask: function(maskedValue, unmaskedValue) {
                var x = maskedValue.split(',');
                return x[0].replace(/\./g, '') + '.' + x[1];
            },
            removeMaskOnSubmit: true
        });

        $('.integer').inputmask({
            alias: "integer",
            digits: 0,
            repeat: 15,
            digitsOptional: false,
            decimalProtect: false,
            groupSeparator: ".",
            placeholder: '0',
            radixFocus: true,
            autoGroup: true,
            autoUnmask: true,
            clearMaskOnLostFocus: false,
            removeMaskOnSubmit: true,
            onBeforeMask: function(value, opts) {
                return value;
            },
            removeMaskOnSubmit: true
        });

        $('.tahun').inputmask({
            alias: "integer",
            repeat: 4,
            digitsOptional: false,
            decimalProtect: false,
            placeholder: '0',
            radixFocus: true,
            autoGroup: true,
            autoUnmask: false,
            onBeforeMask: function(value, opts) {
                return value;
            },
            removeMaskOnSubmit: true
        });
    }
    $(document).ready(function() {
        inputMask();
    });
</script>
<?php $no = 1;
$no_kadar = 1;
$nilai_kadar = 1;
$no4= 1;
$no2 = 1;
$no3 = 1; ?>
@foreach($master_kualitas as $item)
<div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-lg-4 col-form-label">Kadar {{$no4++}} :</label>
            <div class="col-lg-8">
                <span class="font-weight-boldest">{{$item->nama_kualitas}}</span>
                <input type="hidden" name="kadar[]" value="{{$item->id_kualitas}}" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Ekuivalen Logam {{$no2++}} :</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <input type="text" name="ekualivalen_kadar[]" class="form-control kadar">
                            <div class="input-group-append">
                                <select class="form-control" name="ekualivalen_satuan[]">
                                    <option>Ton</option>
                                    <option>Kg</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Nilai Kadar {{$no3++}} :</label>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <input type="text" name="nilai_kadar[]" class="form-control kadar">
                            <div class="input-group-append">
                                <select class="form-control" name="nilai_kadar_satuan[]">
                                    <option>gr/T</option>
                                    <option>%</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<br />
@endforeach
<script>
    $('.kadar').inputmask({
        alias: "decimal",
        digits: 2,
        repeat: 2,
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
</script>
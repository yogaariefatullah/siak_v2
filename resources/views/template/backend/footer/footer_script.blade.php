<script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#0BB783",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#D7F9EF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('assets/plugins/global/plugins.bundle.js?v=7.0.6')}}"></script>
<script src="{{asset('assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6')}}"></script>
<script src="{{asset('assets/js/scripts.bundle.js?v=7.0.6')}}"></script>
<!--end::Global Theme Bundle-->

<!--begin::Page Vendors(used by this page)-->
<script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.6')}}"></script>
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('assets/js/pages/widgets.js?v=7.0.6')}}"></script>
<!--end::Page Scripts-->

<!-- DataTables -->
<script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6')}}"></script>
<link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css?v=7.0.6')}}" rel="stylesheet" type="text/css" />

<!-- Select2 -->
<script src="{{asset('assets/js/pages/crud/forms/widgets/select2.js')}}"></script>

<!-- Input Mask By Daniel D Fortuna -->
{{-- <script src="{{ url('js/inputmask/jquery.inputmask.bundle.min.js') }}" charset="utf-8"></script> --}}

<script>
    const numberFormat = (value, decimals, decPoint, thousandsSep) => {
        decPoint = decPoint || '.';
        decimals = decimals !== undefined ? decimals : 2;
        thousandsSep = thousandsSep || ' ';

        if (typeof value === 'string') {
            value = parseFloat(value);
        }

        let result = value.toLocaleString('en-US', {
            maximumFractionDigits: decimals,
            minimumFractionDigits: decimals
        });

        let pieces = result.split('.');
        pieces[0] = pieces[0].split(',').join(thousandsSep);

        return pieces.join(decPoint);
    };
    $('.volume').inputmask({
        alias: "decimal",
        digits: 4,
        repeat: 36,
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
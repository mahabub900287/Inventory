<!-- ==== CSS Dependencies Start ==== -->
<link rel="stylesheet" href="{{ asset('assets/admin/vendors/vendor-min.css') }}" />
<!-- flatpickr -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- ==== CSS Dependencies End ==== -->
<!-- default grey-theme -->
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/grey-theme/jquery.fonticonpicker.grey.min.css" />

<!-- optional themes | no need to include default theme -->
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/bootstrap-theme/jquery.fonticonpicker.bootstrap.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/dark-grey-theme/jquery.fonticonpicker.darkgrey.min.css" />
<link rel="stylesheet" type="text/css"
    href="https://unpkg.com/@fonticonpicker/fonticonpicker@3.0.0-alpha.0/dist/css/themes/inverted-theme/jquery.fonticonpicker.inverted.min.css" />
{{ $topStyle ?? '' }}
<!-- Main css -->
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}" />
<!--Custom css use development purpose-->
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/common/css/custom.css') }}" />
{{ $bottomStyle ?? '' }}
{{-- @vite('resources/css/app.css') --}}

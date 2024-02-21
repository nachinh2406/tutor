<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Admin - Gia Sư Ngọc Anh</title>
    <link rel="apple-touch-icon" href="{{asset("backend/app-assets/images/ico/apple-icon-120.png")}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("backend/app-assets/images/ico/favicon.ico")}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/vendors.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/extensions/toastr.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/forms/select/select2.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/tables/datatable/buttons.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap5.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/lib/main.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css")}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/extensions/sweetalert2.min.css")}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/bootstrap.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/bootstrap-extended.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/colors.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/components.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/themes/dark-layout.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/themes/bordered-layout.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/themes/semi-dark-layout.css")}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/core/menu/menu-types/vertical-menu.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/plugins/extensions/ext-component-toastr.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/plugins/forms/form-validation.css")}}">
    <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/plugins/extensions/ext-component-sweet-alerts.css")}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("backend/assets/css/style.css")}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include("backend.layouts.header")
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include("backend.layouts.sidebar")
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    @yield("content")
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include("backend.layouts.footer")
    <!-- END: Footer-->

    <!-- BEGIN: tinymsc-->
    @include("backend.components.tinymsc")
    <!-- END: tinymsc-->
    <!-- BEGIN: Vendor JS-->
    <script src="{{asset("backend/app-assets/vendors/js/vendors.min.js")}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->

    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset("backend/app-assets/vendors/js/extensions/toastr.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/forms/select/select2.full.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/jszip.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/pdfmake.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/vfs_fonts.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/buttons.html5.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/buttons.print.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/forms/cleave/cleave.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/forms/cleave/addons/cleave-phone.us.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/lib/main.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/extensions/moment.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/charts/chart.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js")}}"></script>
    <script src="{{asset("backend/app-assets/vendors/js/extensions/sweetalert2.all.min.js")}}"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{asset("backend/app-assets/js/core/app-menu.js")}}"></script>
    <script src="{{asset("backend/app-assets/js/core/app.js")}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset("backend/app-assets/js/scripts/extensions/ext-component-toastr.js")}}"></script>
    <!-- END: Page JS-->
    <script src="{{asset("backend/app-assets/js/lib.js")}}"></script>
    @include("backend.components.toastr")
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
        const ROOT_S3 = '@php echo ROOT_S3  @endphp';
    </script>

    @stack("js")
    @stack("css")
</body>
<!-- END: Body-->

</html>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from codeminifier.com/workio-job-board-template/workio/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 31 Oct 2019 03:34:56 GMT -->
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Workio - Most Powerful & Largest Job Board Template</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- All Plugins Css -->
        <link href="{{asset("frontend/assets/css/plugins.css")}}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{asset("frontend/assets/css/styles.css")}}" rel="stylesheet">

		<!-- Custom Color -->
		<link href="{{asset("frontend/assets/css/skin/default.css")}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/extensions/toastr.min.css")}}">
        <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/plugins/extensions/ext-component-toastr.css")}}">
        <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/css/plugins/forms/form-validation.css")}}">
        <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css")}}">
        <link rel="stylesheet" type="text/css" href="{{asset("backend/app-assets/vendors/lib/main.min.css")}}">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>

    <body class="blue-skin">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader"></div>

        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">

            <!-- ============================================================== -->
            <!-- Top header  -->
            <!-- ============================================================== -->
            @include("frontend.layouts.header")
			<!-- ============================================================== -->
			<!-- Top header  -->
			<!-- ============================================================== -->



            @yield("content")




			<!-- ============================ Footer Start ================================== -->
            @include("frontend.layouts.footer")
			<!-- ============================ Footer End ================================== -->

			<!-- Log In Modal -->
            @include("frontend.models.login")
			<!-- End Modal -->

			<!-- Sign Up Modal -->
            @include("frontend.models.signup")
			<!-- End Modal -->

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- Color Switcher -->
		<div class="style-switcher">
			<h2 class="css-trigger"><a href="#"><i class="ti-settings"></i></a></h2>
			<div>
				<ul id="themecolors" class="m-t-20">
					<li><a href="javascript:void(0)" data-skin="default-skin" class="default-theme">1</a></li>
					<li><a href="javascript:void(0)" data-skin="red-skin" class="red-theme">2</a></li>
					<li><a href="javascript:void(0)" data-skin="green-skin" class="green-theme">3</a></li>
					<li><a href="javascript:void(0)" data-skin="blue-skin" class="blue-theme">4</a></li>
					<li><a href="javascript:void(0)" data-skin="yellow-skin" class="yellow-theme">5</a></li>
					<li><a href="javascript:void(0)" data-skin="purple-skin" class="purple-theme">6</a></li>
					<li><a href="javascript:void(0)" data-skin="pink-skin" class="pink-theme">7</a></li>
					<li><a href="javascript:void(0)" data-skin="lightblue-skin" class="lightblue-theme">8</a></li>
					<li><a href="javascript:void(0)" data-skin="darkgreen-skin" class="darkgreen-theme">9</a></li>
					<li><a href="javascript:void(0)" data-skin="darkyellow-skin" class="darkyellow-theme">10</a></li>
					<li><a href="javascript:void(0)" data-skin="lightpink-skin" class="lightpink-theme">11</a></li>
					<li><a href="javascript:void(0)" data-skin="empblue-skin" class="empblue-theme">12</a></li>
				</ul>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset("frontend/assets/js/jquery.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/popper.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/bootstrap.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/select2.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/aos.js")}}"></script>
		<script src="{{asset("frontend/assets/js/perfect-scrollbar.jquery.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/owl.carousel.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/jquery.counterup.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/slick.js")}}"></script>
		<script src="{{asset("frontend/assets/js/bootstrap-datepicker.js")}}"></script>
		<script src="{{asset("frontend/assets/js/isotope.min.js")}}"></script>
		<script src="{{asset("frontend/assets/js/summernote.js")}}"></script>
		<script src="{{asset("frontend/assets/js/jQuery.style.switcher.js")}}"></script>
		<script src="{{asset("frontend/assets/js/cl-switch.js")}}"></script>
		<script src="{{asset("frontend/assets/js/custom.js")}}"></script>
        <script src="{{asset("backend/app-assets/vendors/js/extensions/toastr.min.js")}}"></script>
        <script src="{{asset("backend/app-assets/js/scripts/extensions/ext-component-toastr.js")}}"></script>
        <script src="{{asset("backend/app-assets/vendors/js/forms/validation/jquery.validate.min.js")}}"></script>
        <script src="{{asset("backend/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js")}}"></script>
        <script src="{{asset("backend/app-assets/vendors/lib/main.min.js")}}"></script>
        <script src="{{asset("backend/app-assets/vendors/js/extensions/moment.min.js")}}"></script>
        <script src="{{asset("frontend/js/authenticate.js")}}"></script>
        <script src="{{asset("frontend/js/common.js")}}"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->
        @include("backend.components.toastr")
        @stack("js")
	</body>
</html>

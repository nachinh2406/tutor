@extends("frontend.layouts.master")
@section("content")
	<!-- ============================ Hero Banner  Start================================== -->
    @include("frontend.layouts.banner_profile")
    <!-- ============================ Hero Banner End ================================== -->
		<!-- ============== Candidate Dashboard ====================== -->
        <section class="tr-single-detail gray-bg">
            <div class="container">
                <div class="row">

                    <!-- Sidebar Start -->
                    @include("frontend.layouts.sidebar_profile")
                    <!-- /col-md-4 -->

                    <div class="col-md-8 col-sm-12">
                        <!-- Tab panes -->
                        <div class="tab-content">

                            <!-- My Profile -->
                            <div class="tab-pane active container" id="profile">
                                <!-- info id card -->
                                @extends("frontend.layouts.master")
@section("content")
	<!-- ============================ Hero Banner  Start================================== -->
    @include("frontend.layouts.banner_profile")
    <!-- ============================ Hero Banner End ================================== -->
		<!-- ============== Candidate Dashboard ====================== -->
        <section class="tr-single-detail gray-bg">
            <div class="container">
                <div class="row">

                    <!-- Sidebar Start -->
                    @include("frontend.layouts.sidebar_profile")
                    <!-- /col-md-4 -->

                    <div class="col-md-8 col-sm-12">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <form action="{{route("profile.password.change")}}" method="post" class="form-change-password">
                                @csrf
                                <div class="tab-pane active container" id="profile">
                                    <!-- info id card -->
                                    <div class="tr-single-box">
                                        <div class="tr-single-header">
                                            <h4><i class="ti-new-window"></i>Thay đổi mật khẩu</h4>
                                        </div>
                                        <div class="tr-single-body">
                                            <div class="form-group">
                                                <label>Mật khẩu hiện tại</label>
                                                <input class="form-control" type="password" id="current_password" name="current_password">
                                            </div>
                                            <div class="form-group">
                                                <label>Mật khẩu mới</label>
                                                <input class="form-control" type="password" id="password" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label>Nhập lại mật khẩu</label>
                                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Social Account -->
                                    <button href="#" class="btn btn-info btn-md full-width">Submit<i class="ml-2 ti-arrow-right"></i></a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============== Candidate Dashboard ====================== -->

@endsection

                                <!-- /Social Account -->
                                <a href="#" class="btn btn-info btn-md full-width">Submit<i class="ml-2 ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============== Candidate Dashboard ====================== -->

@endsection
@push("js")
<script src="{{asset("frontend/js/profile.changePassword.js")}}"></script>
@endpush

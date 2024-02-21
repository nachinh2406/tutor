@extends("backend.layouts.master")
@section("content")
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Security</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Account Settings</a>
                                </li>
                                <li class="breadcrumb-item active">Security
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills mb-2">
                        <!-- account -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{route("admin.profile")}}">
                                <i data-feather="user" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Hồ sơ cá nhân</span>
                            </a>
                        </li>
                        <!-- security -->
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route("admin.security")}}">
                                <i data-feather="lock" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Bảo mật</span>
                            </a>
                        </li>
                    </ul>

                    <!-- security -->

                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Thay đổi mật khẩu</h4>
                        </div>
                        <div class="card-body pt-1">
                            <!-- form -->
                            <form class="validate-form" method="POST" action="{{route("admin.security.store")}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="account-old-password">Mật khẩu hiện tại</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="account-old-password" name="current_password" placeholder="" data-msg="Please current password" />
                                            <div class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="account-new-password">Mật khẩu mới</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" id="account-new-password" name="password" class="form-control" placeholder="" />
                                            <div class="input-group-text cursor-pointer">
                                                <i data-feather="eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="account-retype-new-password">Nhập lại mật khẩu</label>
                                        <div class="input-group form-password-toggle input-group-merge">
                                            <input type="password" class="form-control" id="account-retype-new-password" name="password_confirmation" placeholder="" />
                                            <div class="input-group-text cursor-pointer"><i data-feather="eye"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="fw-bolder">Password requirements:</p>
                                        <ul class="ps-1 ms-25">
                                            <li class="mb-50">Tối thiểu 8 ký tự hoặc hơn</li>
                                            <li class="mb-50">Ít nhất một ký tự viết hoa</li>
                                            <li>Ít nhất một ký tự, một chữ, một số</li>
                                        </ul>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary me-1 mt-1">Save changes</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
<script src="{{asset("backend/app-assets/js/scripts/pages/modal-two-factor-auth.js?v=r").rand(0,10)}}"></script>
<script src="{{asset("backend/app-assets/js/scripts/pages/page-account-settings-security.js?v=r").rand(0,10)}}"></script>
@endpush

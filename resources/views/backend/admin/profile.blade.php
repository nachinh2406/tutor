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
                        <h2 class="content-header-title float-start mb-0">Account</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Account Settings </a>
                                </li>
                                <li class="breadcrumb-item active"> Account
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
                            <a class="nav-link active" href="{{route("admin.profile")}}">
                                <i data-feather="user" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Hồ sơ cá nhân</span>
                            </a>
                        </li>
                        <!-- security -->
                        <li class="nav-item">
                            <a class="nav-link " href="{{route("admin.security")}}">
                                <i data-feather="lock" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Bảo mật</span>
                            </a>
                        </li>
                    </ul>

                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Profile Details</h4>
                        </div>
                        <div class="card-body py-2 my-25">
                            <!-- header section -->
                            <div class="d-flex">
                                <a href="#" class="me-25">
                                    <img src="{{ROOT_S3.optional($admin->image)->url}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
                                </a>
                                <!-- upload and reset button -->
                                <div class="d-flex align-items-end mt-75 ms-1">
                                    <div>
                                        <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                                        <input type="file" id="account-upload" hidden accept="image/*" />
                                        {{-- <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button> --}}
                                        <p class="mb-0">Loại file cho phép: png, jpg, jpeg.</p>
                                    </div>
                                </div>
                                <!--/ upload and reset button -->
                            </div>
                            <!--/ header section -->

                            <!-- form -->
                            <form class="validate-form mt-2 pt-50" method="post" action="{{route("admin.profile.store")}}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="name">Tên người dùng</label>
                                        <input  type="text" class="form-control" id="name" name="name" value="{{$admin->name}}" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1" style="cursor: not-allowed;">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{$admin->email}}" style="pointer-events: none;"/>
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="phone">Số điện thoại</label>
                                        <input  type="text" class="form-control account-number-mask" id="phone" name="phone" value="{{$admin->phone}}" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="address">Địa chỉ</label>
                                        <input  type="text" class="form-control" id="address" value="{{$admin->address}}" name="address" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="zip_code">Zip Code</label>
                                        <input  type="text" class="form-control account-zip-code" value="{{$admin->zip_code}}" name="zip_code" id="zip_code" maxlength="6" />
                                    </div>
                                    <div class="col-12 col-sm-6 mb-1">
                                        <label for="gender" class="form-label">Giới tính</label>
                                        <select id="gender" name="gender" class="select2 form-select">
                                            <option value="">Lựa chọn</option>
                                            <option {{$admin->gender == GENDER_MALE ? "selected" : "" }} value="1">Nam</option>
                                            <option {{$admin->gender == GENDER_FEMALE ? "selected" : ""}} value="2">Nữ</option>
                                            <option {{$admin->gender == GENDER_DIFFERENT ? "selected" : ""}} value="3">Khác</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-1 me-1">Lưu thông tin</button>
                                        {{-- <button type="reset" class="btn btn-outline-secondary mt-1">Loại bỏ</button> --}}
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>

                    <!-- deactivate account  -->

                    <!--/ profile -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push("js")
<script src="{{asset("backend/app-assets/js/scripts/pages/page-account-settings-account.js?v=r").rand(0,10)}}"></script>
@endpush

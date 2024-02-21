@php
    $routName = Route::currentRouteName();
@endphp

<style>
    .nav-item.active {
        background: #96e58d;
    }
</style>
<div class="col-md-4 col-sm-12">
    <div class="dashboard-wrap">

    <div class="dashboard-thumb">
        <div class="dashboard-th-pic">
            <img src="{{asset(auth()->user()->avatar ?? "frontend/assets/img/user-3.jpg")}}" id="account-upload-img" width="120" style="height:120px !important;" class="uploadedAvatar img-fluid mx-auto img-circle" alt="" />
        </div>
        <div>
            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75 waves-effect waves-float waves-light">Upload</label>
            <input type="file" id="account-upload" hidden="" accept="image/*">
        </div>
        <h4 class="mb-1">{{auth()->user()->name}}</h4>
    </div>

    <!-- Nav tabs -->
    <ul class="nav dashboard-verticle-nav">
        <li class="nav-item {{$routName == "profile.index" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.index")}}"><i class="ti-user"></i>Hồ sơ của tôi</a>
        </li>
        <li class="nav-item {{$routName == "profile.detail" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.detail")}}"><i class="ti-file"></i>Thông tin chi tiết</a>
        </li>
        <li class="nav-item {{$routName == "profile.card" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.card")}}"><i class="lni-heart-filled"></i>CCCD/CMND</a>
        </li>
        <li class="nav-item {{$routName == "profile.calendar" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.calendar")}}"><i class="lni lni-calendar"></i>Đăng ký lịch dạy</a>
        </li>
        <li class="nav-item {{$routName == "profile.class.recieve" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.class.recieve")}}"><i class="lni-briefcase"></i>Note nhận lớp</a>
        </li>
        <li class="nav-item {{$routName == "profile.class.recieved" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.class.recieved")}}"><i class="lni-alarm"></i>Note lớp đã nhận</a>
        </li>
        <li class="nav-item {{$routName == "profile.password.change" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.password.change")}}"><i class="lni-lock"></i>Thay đổi mật khẩu</a>
        </li>
        <li class="nav-item {{$routName == "profile.comment" ? "active" : ""}}">
            <a class="nav-link" href="{{route("profile.comment")}}"><i class="lni-lock"></i>Cảm nhận về trung tâm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href=""><i class="lni-exit"></i>Đăng xuất</a>
        </li>
    </ul>
    </div>
</div>

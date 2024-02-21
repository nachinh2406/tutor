<div class="topbar tp-rlt" id="top">
    <div class="header light">
        <div class="container po-relative">
            <nav class="navbar navbar-expand-lg header-nav-bar">
                <a href="{{route("index")}}" class="navbar-brand">
                    <img src="{{asset("frontend/assets/img/logo.png")}}" class="default-logo" alt="drizvato">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"><span class="ti-align-right"></span></button>
                <div class="collapse navbar-collapse hover-dropdown font-14 ml-auto" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown"> <a class="nav-link" href="{{route("index")}}">Trang chủ</a></li>
                        <li class="nav-item dropdown"> <a class="nav-link" href="{{route("classes")}}" >@auth Các lớp phù hợp @else Các lớp mới @endauth</a></li>
                        <li class="nav-item dropdown"> <a class="nav-link" href="{{route("contract")}}" >Hợp đồng mẫu</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{route('contact')}}">Liên hệ</a></li>
                        @auth
                        <li class="nav-item dropdown"> <a class="nav-link" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}<i class="fa fa-angle-down m-l-5"></i></a>
                            <ul class="b-none dropdown-menu font-14 animated fadeInUp">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}" style="cursor: pointer;" >Hồ sơ cá nhân</a>
                                    <a class="dropdown-item" onclick="document.getElementById('logout').submit();" style="cursor: pointer;" >Đăng xuất</a>
                                </li>
                                <form action="{{ route('logout') }}"
                                    method="POST"
                                    id="logout" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        @endauth
                    </ul>
                    @auth
                    @else
                    <div class="act-buttons">
                        <a class="btn btn-info font-14" href="javascript:void(0)" data-toggle="modal" data-target="#login"><i class="ti-shift-right mr-2"></i>Đăng nhập</a>
                    </div>
                    @endauth
                </div>
            </nav>
        </div>
    </div>
</div>
<div class="clearfix"></div>

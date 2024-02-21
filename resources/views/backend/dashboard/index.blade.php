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
                        <h2 class="content-header-title float-start mb-0">THỐNG KÊ</h2>
                        {{-- {{Breadcrumbs::render('admins.index')}} --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="chartjs-chart">
                <div class="row">
                    <!--Bar Chart Start -->
                    <div class="col-xl-12 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                <div class="header-left">
                                    <h4 class="card-title">Các lớp đăng ký theo tháng</h4>
                                </div>
                                {{-- <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                    <i data-feather="calendar"></i>
                                    <input type="text" class="form-control flat-picker border-0 shadow-none bg-transparent pe-0" placeholder="YYYY-MM-DD" />
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Bar Chart End -->
                </div>
            </section>
        </div>
    </div>
</div>

@endsection
@push("js")
    <script src="{{asset("backend//js/dashboard.js?v=r").rand(0,10)}}"></script>
@endpush

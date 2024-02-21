@extends("frontend.layouts.master")
@section("content")
	<!-- ============================ Hero Banner  Start================================== -->
    @include("frontend.layouts.banner_home")
    <!-- ============================ Hero Banner End ================================== -->

    <!-- ============================ Latest job ================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col text-center">
                    <div class="sec-heading mx-auto">
                        <h2>Các lớp mới gần đây</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="owl-carousel" id="job-slide">
                @foreach ($newClasses as $newClass)
                    <!-- Single Job -->
                    <div class="item">
                        <div class="job-grid style-1">
                            <div class="job-grid-wrap">
                                <h4 class="job-title"><a href="{{route("classes.detail", $newClass->id)}}">{{optional($newClass->subject)->name}} - {{optional($newClass->class)->name_class}}</a></h4>
                                <span><b>{{$newClass->code_class}}</b></span>
                                <hr>
                                <div class="job-grid-detail" style="text-align: left;">
                                    <p><i class="ti-location-pin"></i>{{$newClass->ward->name}}, {{$newClass->district->name}}, {{$newClass->province->name}} </p>
                                </div>
                                <div class="job-grid-detail" style="text-align: left;">
                                    <p><i class="ti-money"></i></i>{{$newClass->price_class}}  ₫/tháng, {{$newClass->number_lesson_week}} buổi/tuần</p>
                                </div>
                                <div class="job-grid-detail" style="text-align: left;">
                                    <p><i class="ti-bookmark"></i>Yêu cầu: {{$newClass->role_user == 1 ? "Giáo viên": "Sinh viên"}} {{$newClass->gender_request == GENDER_MALE ? "nam" : ($newClass->gender_request == GENDER_FEMALE ? "nữ" : "" )}}</p>
                                </div>
                                <div class="job-grid-footer" style="justify-content: space-around;">
                                    <a href="{{route("classes.detail", $newClass->id)}}" class="btn btn-outline-info btn-rounded">Chi tiết</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

        </div>
    </section>
    <!-- ============================ Latest Job End ================================== -->

    <!-- ============================ Popular Candidate Start ================================== -->
    <section class="image-bg image-light text-center" style="background: url({{asset("frontend/assets/img/des-9.jpg")}});" data-overlay="8">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col text-center">
                    <div class="sec-heading light mx-auto">
                        <h2>Danh sách các gia sư tiêu biểu</h2>
                    </div>
                </div>

                <div class="row m-0">
                    @foreach ($users as $user)
                        <!-- Popular Candidate -->
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="best-candidate">

                                <div class="best-candidate-wrap">
                                    <div class="best-candidate-thumb">
                                        <img src="{{asset($user->avatar)}}" style="width:90px !important; height:90px !important;" class="img-fluid mx-auto rounded-circle" alt="" />
                                        <div class="c-ac-status"><i class="ti-check"></i></div>
                                    </div>
                                    <h4 class="candidate-name"><a href="candidate-detail.html">{{$user->name}}</a></h4>
                                    <span class="can-post">{{$user->position == 1 ? "Giảng viên" : "Sinh viên"}}</span>

                                    <div class="best-candidate-info">
                                        <div class="c-total-award"></div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Popular Candidate End ================================== -->

    <!-- ============================ Category Start ================================== -->
    <section>
        <div class="container">

            <div class="row">
                <div class="col text-center">
                    <div class="sec-heading mx-auto">
                        <h2>Dịch vụ của chúng tôi</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <ul class="category-wrap">

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/construction.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Tư vấn và định hướng</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/accounting.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Tìm kiếm gia sư phù hợp</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/full-support.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Đảm bảo chất lượng</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/health.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Đa dạng lựa chọn</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/design.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Linh hoạt về thời gian và địa điểm</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/education.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Giáo trình và tài liệu</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/car.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Theo dõi và đánh giá</h4>
                        </a>
                    </li>

                    <li>
                        <a href="#javascript" class="standard-category-box">
                            <img src="{{asset("frontend/assets/img/bank.png")}}" class="img-fluid mx-auto" alt="" />
                            <h4>Hỗ trợ khách hàng</h4>
                        </a>
                    </li>

                </ul>

            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ============================ Category End ================================== -->

    <!-- ============================ Testimonial  Start================================== -->
    <section class="image-bg text-center" style="margin-bottom:64px; background: url({{asset("frontend/assets/img/bn-3.jpg")}});" data-overlay="8">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-10">
                    <div class="owl-carousel testimonial-3" id="testimonial-3-slide">

                        @foreach ($commentUsers as $commentUser)
                            <!-- Single Testimonial -->
                            <div class="item">
                                <div class="tauth-thumb" style="height:110px;">
                                    <img style="height: 100%;" src="{{asset($commentUser->avatar)}}" class="mx-auto img-circle" alt="" />
                                </div>
                                <div class="tauth-detail">
                                    <h4 class="tauth-title">{{$commentUser->name}}</h4>
                                    <span class="tauth-subtitle">{{$commentUser->position == 1 ? "Giáo viên" : ($commentUser->position == 2 ? "Sinh viên" : "")}}</span>
                                    <p>{{$commentUser->comment}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Testimonial End ================================== -->
@endsection

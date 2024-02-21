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
                                <div class="tab-pane" id="applied">

                                    <div class="tr-single-box">
                                        <div class="tr-single-header">
                                            <h4><i class="ti-briefcase"></i>Note nhận lớp</h4>
                                        </div>

                                        <div class="tr-single-body">

                                            @foreach ($classesApplied as $classApplied)
                                                <div class="manage-list">
                                                    <div class="mg-list-wrap">
                                                        <div class="mg-list-caption">
                                                            <span class="mg-subtitle" style="font-weight:bold;">{{$classApplied->code_class}}</span>
                                                            <h4 class="mg-title">{{optional($classApplied->subject)->name}} - {{optional($classApplied->class)->name_class}}</h4>
                                                            <span class="d-block">{{$classApplied->price_class}}  ₫/tháng, {{$classApplied->number_lesson_week}} buổi/tuần</span>
                                                            <span><em>{{\Carbon\Carbon::parse($classApplied->pivot->created_at)->diffForHumans()}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="mg-action">
                                                        <div class="btn-group ml-2">
                                                            <a href="job-detail.html" class="btn btn-view" data-toggle="tooltip" data-placement="top" title="Xem chi tiết lớp"><i class="ti-eye"></i></a>
                                                            <a href="#" class="mg-delete ml-2" data-toggle="tooltip" data-placement="top" title="Hủy nhận lớp"><i class="ti-trash"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach


                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============== Candidate Dashboard ====================== -->

@endsection

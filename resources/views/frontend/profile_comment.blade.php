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
                                        <form action="{{route("profile.comment")}}" method="post" class="form-change-password">
                                            @csrf
                                            <div class="tab-pane active container" id="profile">
                                                <!-- info id card -->
                                                <div class="tr-single-box">
                                                    <div class="tr-single-header">
                                                        <h4><i class="ti-new-window"></i>Cảm nhận về trung tâm</h4>
                                                    </div>
                                                    <div class="tr-single-body">
                                                        <div class="form-group">
                                                            <label>Nội dung</label>
                                                            <textarea required class="form-control" id="comment" name="comment">{!! auth()->user()->comment !!}</textarea>
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
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============== Candidate Dashboard ====================== -->

@endsection

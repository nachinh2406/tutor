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
                                <form action="{{route('profile.update')}}" enctype="multipart/form-data" method="post">
                                @csrf
                                <input type="hidden" name="type" value="DETAIL_PROFILE">
                                <!-- Social Account -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-new-window"></i>Mạng xã hội</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="url_facebook"><i class="lni-facebook"></i>Facebook URL</label>
                                                    <input class="form-control" name="url_facebook" id="url_facebook" type="text" value="{{$user->url_facebook}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="url_google"><i class="lni-google-plus"></i>Google+ URL</label>
                                                    <input class="form-control" name="url_google" id="url_google" type="text" value="{{$user->url_google}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="url_linkedIn"><i class="lni-linkedin"></i>LinkedIn URL</label>
                                                    <input class="form-control" id="url_linkedIn" name="url_linkedIn" type="text" value="{{$user->url_linkedIn}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="url_twitter"><i class="lni-twitter"></i>Twitter URL</label>
                                                    <input class="form-control" id="url_twitter" name="url_twitter" type="text" value="{{$user->url_twitter}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /Social Account -->

                                <!-- Advance Information -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-heart"></i>Thông tin chi tiết</h4>
                                    </div>

                                    <div class="tr-single-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo">Trường</label>
                                                    <select name="school_id" class="form-control" id="school_id">
                                                        <option value=""></option>
                                                        @foreach ($schools as $school)
                                                            <option {{$school->id == $user->school_id ? "selected" : ""}} value="{{$school->id}}">{{$school->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="major_name" class="social-nfo">Ngành học</label>
                                                    <input class="form-control" name="major_name" id="major_name" type="text" value="{{$user->major_name}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="start_from">Bắt đầu</label>
                                                    <input class="form-control flatpickr-date" id="start_from" name="start_from" style="background-color:#fff;" type="text" value="{{\Carbon\Carbon::parse($user->start_from)->format("d-m-Y")}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="end_from">Kết thúc</label>
                                                    <input class="form-control flatpickr-date" id="end_from" name="end_from" style="background-color:#fff;" type="text" value="{{\Carbon\Carbon::parse($user->end_from)->format("d-m-Y")}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="is_experience">Kinh nghiệm (Nếu có)</label>
                                                    <input class="form-control" name="is_experience" id="is_experience" type="text" value="{{$user->is_experience}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="social-nfo" for="date_of_birth">Ngày sinh</label>
                                                    <input class="form-control flatpickr-date" id="date_of_birth" name="date_of_birth" style="background-color:#fff;" type="text" value="{{\Carbon\Carbon::parse($user->date_of_birth)->format("d-m-Y")}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="class_id">Khối có thể dạy</label>
                                                    <select name="class_id[]" multiple class="form-control" id="class_id">
                                                        @foreach ($classes as $class)
                                                            <option {{in_array($class->id,$classSelected) ? "selected" : ""}} value="{{$class->id}}">{{$class->name_class}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="subject_id">Môn học có thể dạy</label>
                                                    <select name="subject_id[]" multiple class="form-control" id="subject_id">
                                                        @foreach ($subjects as $subject)
                                                            <option {{in_array($subject->id,$subjectSelected) ? "selected" : ""}} value="{{$subject->id}}">{{$subject->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /Advance Information -->
                                <button type="submit" class="btn btn-info btn-md full-width">Submit<i class="ml-2 ti-arrow-right"></i></button>
                            </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============== Candidate Dashboard ====================== -->

@endsection
@push("js")
<script src="{{asset("frontend/js/profile.detail.js")}}"></script>
@endpush

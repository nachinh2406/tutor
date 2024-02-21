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
                                    <input type="hidden" name="type" value="INDEX_PROFILE">
                                    <!-- Basic Info -->
                                    <div class="tr-single-box">
                                        <div class="tr-single-header">
                                            <h4><i class="ti-desktop"></i>Thông tin cơ bản</h4>
                                        </div>

                                        <div class="tr-single-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Tên đầy đủ</label>
                                                        <input class="form-control" name="name" type="text" value="{{$user->name}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Giới tính</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="">Giới tính</option>
                                                            <option {{$user->gender == GENDER_MALE ? "selected" : ""}} value="1">Nam</option>
                                                            <option {{$user->gender == GENDER_FEMALE ? "selected" : ""}}  value="2">Nữ</option>
                                                            <option {{$user->gender == GENDER_DIFFERENT ? "selected" : ""}}  value="3">Khác</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Vai trò</label>
                                                        <select name="position" id="position" class="form-control">
                                                            <option value="">Chọn vai trò</option>
                                                            <option {{$user->gender == 1 ? "selected" : ""}} value="1">Sinh viên</option>
                                                            <option {{$user->gender == 2 ? "selected" : ""}} value="2">Giáo viên</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Thẻ sinh viên/ Thẻ giáo viên</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="verify_get_class_photo" class="custom-file-input" id="verify_get_class_photo">
                                                            <label class="custom-file-label" for="verify_get_class_photo">Chọn file</label>
                                                        </div>
                                                        <div class="img-card">
                                                            @if ($user->verify_get_class_photo)
                                                                <img src="{{asset($user->verify_get_class_photo)}}" width="300" height="150" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div class="form-group">
                                                        <label for="note_introduce">Giới thiệu tổng quan</label>
                                                        <textarea name="note_introduce" id="note_introduce" class="form-control" cols="30" rows="10">{!! $user->note_introduce !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Basic Info -->

                                    <!-- Contact Info -->
                                    <div class="tr-single-box">
                                        <div class="tr-single-header">
                                            <h4><i class="ti-headphone"></i> Thông tin liên hệ</h4>
                                        </div>

                                        <div class="tr-single-body">
                                            <div class="row">

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="phone">Số điện thoại</label>
                                                        <input class="form-control" name="phone"  id="phone" type="text" value="{{$user->phone}}">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Email</label>
                                                        <input class="form-control" type="text" value="{{$user->email}}" disabled >
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Tỉnh thành phố</label>
                                                        <select class="form-select form-control" id="province_id" name="province_id" onchange="handleLoadData(event,1, '#district_id')">
                                                            <option value="">Lựa chọn</option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{$province->id}}">{{$province->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="district_id">Quận huyện</label>
                                                        <select class="form-select form-control" id="district_id" onchange="handleLoadData(event,2,'#ward_id')" name="district_id">
                                                            <option value="">Lựa chọn</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="ward_id">Xã Phường</label>
                                                        <select class="form-select form-control" id="ward_id" name="ward_id">
                                                            <option value="">Lựa chọn</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <div class="form-group">
                                                        <label class="social-nfo">Địa chỉ cụ thể</label>
                                                        <input class="form-control"name="address" id="address" type="text" value="{{$user->address}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /Contact Info -->
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
<script>
    var provinceId = "{{$user->province_id}}";
    var districtId = "{{$user->district_id}}";
    var wardId = "{{$user->ward_id}}";
</script>
<script src="{{asset("frontend/js/profile.index.js")}}"></script>
@endpush

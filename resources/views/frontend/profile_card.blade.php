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
                                <input type="hidden" name="type" value="CARD_PROFILE">
                                <!-- info id card -->
                                <div class="tr-single-box">
                                    <div class="tr-single-header">
                                        <h4><i class="ti-new-window"></i>Thông tin CCCD/CMND</h4>
                                    </div>
                                    <div class="tr-single-body">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="number_card">Số CCCD/CMND</label>
                                                    <input class="form-control" id="number_card" name="number_card" type="text" value="{{optional($user->card)->number_card}}">
                                                    @if ($errors->has('number_card'))<p class="text-danger">{{ $errors->first('number_card') }}</p>@endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="date_card">Ngày đăng ký</label>
                                                    <input class="form-control flatpickr-date" type="text" id="date_card" style="background-color:#fff;" name="date_card" value="{{optional($user->card)->date_card ? \Carbon\Carbon::parse(optional($user->card)->date_card)->format("d-m-Y") : "" }}">
                                                    @if ($errors->has('date_card'))<p class="text-danger">{{ $errors->first('date_card') }}</p>@endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="expire_card">Ngày hết hạn</label>
                                                    <input class="form-control flatpickr-date" type="text" style="background-color:#fff;" id="expire_card" name="expire_card" value="{{optional($user->card)->expire_card ? \Carbon\Carbon::parse(optional($user->card)->expire_card)->format("d-m-Y") : ""}}">
                                                    @if ($errors->has('expire_card'))<p class="text-danger">{{ $errors->first('expire_card') }}</p>@endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="address">Nơi đăng ký</label>
                                                    <input class="form-control" type="text" value="{{optional($user->card)->address}}" id="address" name="address">
                                                    @if ($errors->has('address'))<p class="text-danger">{{ $errors->first('address') }}</p>@endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Ảnh mặt trước</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="photo_before" class="custom-file-input" id="photo_before">
                                                        <label class="custom-file-label" for="photo_before">Chọn file</label>
                                                        @if ($errors->has('photo_before'))<p class="text-danger">{{ $errors->first('photo_before') }}</p>@endif
                                                        @if (optional($user->card)->photo_before)
                                                            <div class="photo_after"><img width="300" height="150" src="{{asset(optional($user->card)->photo_before)}}" alt=""></div>
                                                        @endif
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Ảnh mặt sau</label>
                                                    <div class="custom-file">
                                                        <input type="file" name="photo_after" class="custom-file-input" id="photo_after">
                                                        <label class="custom-file-label" for="photo_after">Chọn file</label>
                                                        @if ($errors->has('photo_after'))<p class="text-danger">{{ $errors->first('photo_after') }}</p>@endif
                                                        @if (optional($user->card)->photo_after)
                                                            <div class="photo_after"><img width="300" height="150" src="{{asset(optional($user->card)->photo_after)}}" alt=""></div>
                                                        @endif
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /Social Account -->
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
<script src="{{asset("frontend/js/profile.card.js")}}"></script>
@endpush

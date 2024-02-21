@extends("frontend.layouts.master")
@section("content")
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
    box-sizing: border-box;
    list-style: none;
    margin: 0;
    padding: 0 5px;
    width: 100%;
    display: inline-flex !important;
}
</style>
	<!-- ============================ Search Form Start================================== -->
    <section class="dark-search">
        <div class="container">

            <form class="search-dark-form" method="get">
                <div class="row">

                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <input type="text" name="search" value="{{$searchSelected}}" class="form-control" placeholder="Tìm kiếm lớp tại đây">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <select id="level_class" multiple name="level_class[]" class="js-states form-control">
                                <option value="">&nbsp;</option>
                                <option {{in_array(LEVEL_HIGH_SCHOOL,$levelClassSelected) ? "selected" : ""}} value="1">Cấp THPT</option>
                                <option {{in_array(LEVEL_SECOND_SCHOOL,$levelClassSelected) ? "selected" : ""}}  value="2">Cấp THCS</option>
                                <option {{in_array(LEVEL_PRIMARY_SCHOOL,$levelClassSelected) ? "selected" : ""}}  value="3">Cấp Tiểu học</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <select id="position" multiple class="position" name="position[]" class="js-states form-control">
                                <option value="">&nbsp;</option>
                                <option {{in_array(1,$positionSelected) ? "selected" : ""}} value="1">Giáo viên</option>
                                <option {{in_array(2,$positionSelected) ? "selected" : ""}} value="2">Sinh viên</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <select id="province_id" name="province_id" class="js-states form-control" onchange="handleLoadData(event,1, '#district_id')">
                                <option value="">&nbsp;</option>
                                @foreach ($provinces as $province)
                                <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <select id="district_id" name="district_id" class="js-states form-control" onchange="handleLoadData(event,2,'#ward_id')">
                                <option value="">&nbsp;</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="form-group">
                            <select id="ward_id" name="ward_id" class="js-states form-control">
                                <option value="">&nbsp;</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <button type="submit" class="btn btn-search-dark full-width">Lọc ngay</button>
                    </div>

                </div>
            </form>

        </div>
    </section>
    <!-- ============================ Search Form End ================================== -->

    <section>
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h4>Đang có: {{$countClass}} lớp</h4>
                </div>
            </div>
            <!-- /row -->

            <div class="row">
                @forelse ($classes as $class)
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="job-grid style-1">
                        <div class="job-grid-wrap">
                            <h4 class="job-title"><a href="{{route("classes.detail", $class->id)}}">{{optional($class->subject)->name}} - {{optional($class->class)->name_class}}</a></h4>
                            <span><b>{{$class->code_class}}</b></span>
                            <hr>
                            <div class="job-grid-detail" style="text-align: left;">
                                <p><i class="ti-location-pin"></i>{{$class->ward->name}}, {{$class->district->name}}, {{$class->province->name}} </p>
                            </div>
                            <div class="job-grid-detail" style="text-align: left;">
                                <p><i class="ti-money"></i></i>{{$class->price_class}}  ₫/tháng, {{$class->number_lesson_week}} buổi/tuần</p>
                            </div>
                            <div class="job-grid-detail" style="text-align: left;">
                                <p><i class="ti-bookmark"></i>Yêu cầu: {{$class->role_user == 1 ? "Giáo viên": "Sinh viên"}} {{$class->gender_request == GENDER_MALE ? "nam" : ($class->gender_request == GENDER_FEMALE ? "nữ" : "" )}}</p>
                            </div>
                            <div class="job-grid-footer" style="justify-content: space-around;">
                                <a href="{{route("classes.detail", $class->id)}}" class="btn btn-outline-info btn-rounded">Chi tiết</a>
                                @php
                                $checkAppliedClass = $class->users != null ? $class->users->first(function($item) {
                                    Log::info("message".$item->id);
                                    return $item->id == optional(auth()->user())->id;
                                }) !== null : false;

                                @endphp
                                @if ($checkAppliedClass)
                                <button type="submit" class="btn btn-outline-info btn-rounded">Đã nhận</button>
                                @else
                                <form action="{{route("class.apply", $class->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-info btn-rounded">Nhận lớp</button>
                                </form>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-warning" role="alert">
                    Không có lớp nào có sẵn !!!!
                  </div>
                @endforelse
                <!-- Single Job -->
        </div>
        <!-- Pagination -->
        <div class="row text-center d-flex justify-content-center m-auto">
            {!! $classes->appends(request()->input())->render() !!}
        </div>
        <!-- Pagination -->
    </section>
    <div class="clearfix"></div>
@endsection
@push("js")
<script>
    var provinceSelected = "{{$provinceSelected}}";
    var districtSelected = "{{$districtSelected}}";
    var wardSelected = "{{$wardSelected}}";
</script>
<script src="{{asset("frontend/js/classes.js")}}"></script>
@endpush

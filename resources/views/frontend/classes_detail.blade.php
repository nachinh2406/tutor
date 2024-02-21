@extends("frontend.layouts.master")
@section("content")
<style>
    iframe {
        width: 100%;
    }
</style>
	<!-- ============== Job Detail ====================== -->
    <section class="tr-single-detail gray-bg">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12">

                    <!-- Job Overview -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-info"></i>Tổng quan lớp</h4>
                        </div>
                        <div class="tr-single-body">
                            <ul class="jb-detail-list">
                                <li>{{optional($classRegister->subject)->name}} - {{optional($classRegister->class)->name_class}}</li>
                                <li>Phạm vi lớp học: {{$classRegister->scope_class}} học sinh</li>
                                <li>{{$classRegister->ward->name}}, {{$classRegister->district->name}}, {{$classRegister->province->name}} </li>
                                <li>{{$classRegister->price_class}}  ₫/tháng, {{$classRegister->number_lesson_week}} buổi/tuần</li>
                                <li>Phí lớp: {{$classRegister->fee__percentage_class}}% (Chỉ nộp phí 1 lần, những tháng tiếp theo sẽ không mất phí)</li>
                                <li>Yêu cầu: {{$classRegister->role_user == 1 ? "Giáo viên": "Sinh viên"}} {{$classRegister->gender_request == GENDER_MALE ? "nam" : ($classRegister->gender_request == GENDER_FEMALE ? "nữ" : "" )}}</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Job Qualifications -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-book"></i>Yêu cầu</h4>
                        </div>
                        <div class="tr-single-body">
                            {!! $classRegister->request_class !!}
                        </div>
                    </div>


                    <!-- Job Education -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-cup"></i>Đặc điểm học sinh</h4>
                        </div>
                        <div class="tr-single-body">
                            {!! $classRegister->student_note !!}
                        </div>
                    </div>

                    @php
                    $checkAppliedClass = $classRegister->users != null ? $classRegister->users->first(function($item) {
                        Log::info("message".$item->id);
                        return $item->id == optional(auth()->user())->id;
                    }) !== null : false;

                    @endphp
                    @if ($checkAppliedClass)
                    <button type="submit" class="btn btn-outline-info btn-rounded">Đã nhận</button>
                    @else
                    <form action="{{route("class.apply", $classRegister->id)}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-info btn-rounded">Nhận lớp</button>
                    </form>
                    @endif

                </div>

                <!-- Sidebar Start -->
                <div class="col-md-6 col-sm-12">
                    <!-- Company Address -->
                    <div class="tr-single-box">
                        <div class="tr-single-header">
                            <h4><i class="ti-direction"></i>Địa chỉ map</h4>
                        </div>

                        <div class="tr-single-body">
                            {!! $classRegister->embed_map !!}
                        </div>

                    </div>
                </div>
                <!-- /col-md-4 -->
            </div>
        </div>
    </section>
    <!-- ============== Job Detail ====================== -->
@endsection
@push("js")
<script src="{{asset("frontend/js/classes.js")}}"></script>
@endpush

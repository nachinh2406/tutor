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
                        <h2 class="content-header-title float-start mb-0">Cặp nhập lớp đăng ký</h2>
                        {{Breadcrumbs::render('classes-register.show', $classRegister)}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Validation -->
            <section class="bs-validation">
                <div class="row">
                    <!-- Bootstrap Validation -->
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home" aria-expanded="true">Cập nhật lớp đăng ký</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link add-calendar-register-class" id="profile-tab" data-bs-toggle="pill" href="#profile" aria-expanded="false">Thêm lịch cho lớp</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                                        <form method="POST" action="{{route("admin.classes-register.update", $classRegister->id)}}" class="needs-validation" enctype="multipart/form-data">
                                            @csrf
                                            @method("PUT")
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="class_id">Lớp đăng ký</label>
                                                        <select class="form-select" id="class_id" name="class_id" required>
                                                            <option value="">Lựa chọn</option>
                                                            @foreach ($classes as $class)
                                                                <option {{$class->id == $classRegister->class_id ? "selected" : ""}} value="{{$class->id}}">{{$class->name_class}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="subject_id">Môn học</label>
                                                        <select class="form-select" id="subject_id" name="subject_id" required>
                                                            <option value="">Lựa chọn</option>
                                                            @foreach ($subjects as $subject)
                                                                <option {{$subject->id == $classRegister->subject_id ? "selected" : ""}} value="{{$subject->id}}">{{$subject->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="scope_class">Phạm vi lớp</label>
                                                        <input type="text" name="scope_class" id="scope_class" value="{{$classRegister->scope_class}}" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="role_user">Nhúng Google map</label>
                                                        <input type="text" name="embed_map" value="{{$classRegister->embed_map}}" id="embed_map" class="form-control"  />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="province_id">Tỉnh thành phố</label>
                                                        <select class="form-select" id="province_id" name="province_id" onchange="handleLoadData(event,1, '#district_id')" placeholder="Tỉnh thành phố" required>
                                                            <option value="">Lựa chọn</option>
                                                            @foreach ($provinces as $province)
                                                                <option {{$province->id == $classRegister->province_id ? "selected" : ""}} value="{{$province->id}}">{{$province->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="district_id">Quận huyện</label>
                                                        <select class="form-select" id="district_id" onchange="handleLoadData(event,2,'#ward_id')" name="district_id" required>
                                                            <option value="">Lựa chọn</option>
                                                            @foreach ($districts as $district)
                                                            <option {{$district->id == $classRegister->district_id ? "selected" : ""}} value="{{$district->id}}">{{$district->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="ward_id">Xã Phường</label>
                                                        <select class="form-select" id="ward_id" name="ward_id" required>
                                                            <option value="">Lựa chọn</option>
                                                            @foreach ($wards as $ward)
                                                            <option {{$ward->id == $classRegister->ward_id ? "selected" : ""}} value="{{$ward->id}}">{{$ward->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="gender_request">Giới tính</label>
                                                        <select class="form-select" id="gender_request" name="gender_request" required>
                                                            <option {{1 == $classRegister->gender_request ? "selected" : ""}} value="1">Nam</option>
                                                            <option {{2 == $classRegister->gender_request ? "selected" : ""}} value="2">Nữ</option>
                                                            <option {{3 == $classRegister->gender_request ? "selected" : ""}} value="3">Khác</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="price_class">Giá lớp</label>
                                                        <input type="text" name="price_class" id="price_class" class="form-control format_number" value="{{$classRegister->price_class}}" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="number_lesson_week">Số buổi / tuần</label>
                                                        <input type="text" name="number_lesson_week" id="number_lesson_week" class="form-control" value="{{$classRegister->number_lesson_week}}" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="fee__percentage_class">Phí lớp</label>
                                                        <input type="text" name="fee__percentage_class" id="fee__percentage_class" class="form-control" value="{{$classRegister->fee__percentage_class}}" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="role_user">Yêu cầu người dạy</label>
                                                        <select class="form-select" name="role_user" id="role_user">
                                                            <option value="">Lựa chọn</option>
                                                            @foreach (ROLE_USER as $key=>$gender)
                                                                <option {{$key == $classRegister->role_user ? "selected" : ""}} value="{{$key}}">{{$gender}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="request_class">Yêu cầu lớp</label>
                                                        <textarea name="request_class" id="request_class" rows="20">
                                                            {!! $classRegister->request_class !!}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="mb-1">
                                                        <label class="form-label" for="student_note">Đặc điểm học sinh</label>
                                                        <textarea name="student_note" id="student_note" rows="20">
                                                            {!! $classRegister->student_note !!}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 col-12">
                                                    <div class="mb-1">
                                                        <select class="form-select" name="status" id="status" required>
                                                            @foreach (App\Models\ClassRegister::STATUS as $key=>$status)
                                                            <option {{$key == $classRegister->status ? "selected" : ""}} value="{{$key}}">{{$status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="is_experienced" id="is_experienced" value="1" {{$classRegister->is_experienced ? "checked" : ""}}>
                                                        <label class="form-check-label" for="is_experienced" >Yêu cầu kinh nghiệm</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="is_university_top" id="is_university_top" value="1" {{$classRegister->is_university_top ? "checked" : ""}}>
                                                        <label class="form-check-label" for="is_university_top" >Yêu cầu SV trường TOP</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="is_calendar" id="is_calendar" value="1" {{$classRegister->is_calendar ? "checked" : ""}}>
                                                        <label class="form-check-label" for="is_calendar" >Có sử dụng calendar</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </form>

                                    </div>
                                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                                           <!-- Calendar -->
                                           <div class="col position-relative">
                                                <div class="card shadow-none border-0 mb-0 rounded-0">
                                                    <div class="card-body pb-0">
                                                        <div id="calendar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- /Calendar -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Bootstrap Validation -->
                </div>
            </section>
            <!-- /Validation -->
        </div>
    </div>
</div>
         <!-- Calendar Add/Update/Delete event modal-->
         <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
            <div class="modal-dialog sidebar-lg">
                <div class="modal-content p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title"></h5>
                    </div>
                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        <form class="event-form needs-validation" data-ajax="false" novalidate id="form-calendar-register" method="post" action="{{route("admin.api.classes-register.calendar",$classRegister->id)}}">
                           @csrf
                            <input type="hidden" class="date_class" name="date_class" id="date_class">
                            <input type="hidden" class="calendar_id" name="calendar_id" id="calendar_id">
                            <div class="mb-1">
                                <label for="day_class_register" class="form-label">Thứ</label>
                                <select class="select2 day_class_register form-select w-100" id="day_class_register" name="day_class_register">
                                    <option  value="Sun">Chủ nhật</option>
                                    <option  value="Mon">Thứ 2</option>
                                    <option  value="Tue">Thứ 3</option>
                                    <option  value="Wed">Thứ 4</option>
                                    <option  value="Thu">Thứ 5</option>
                                    <option  value="Fri">Thứ 6</option>
                                    <option  value="Sat">Chủ 7</option>
                                </select>
                            </div>
                            <div class="mb-1 position-relative">
                                <label for="start_time" class="form-label">Giờ bắt đầu</label>
                                <input type="text" class="form-control time_flatpickr" id="start_time" style="background-color:#fff;" name="start_time" placeholder="Start Date" />
                            </div>
                            <div class="mb-1 position-relative">
                                <label for="end_time" class="form-label">Giờ kết thúc</label>
                                <input type="text" class="form-control time_flatpickr" id="end_time" style="background-color:#fff;" name="end_time" placeholder="End Date" />
                            </div>
                            <div class="mb-1 d-flex">
                                <button type="submit" class="btn btn-primary add-event-btn me-1">Thêm lịch cho lớp</button>
                                <button type="submit" class="btn btn-primary update-event-btn d-none me-1">Cập nhật</button>
                                <button type="button" class="btn btn-outline-danger btn-delete-event d-none me-1">Xóa</button>
                                <button type="button" class="btn btn-outline-secondary btn-cancel" data-bs-dismiss="modal">Đóng</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Calendar Add/Update/Delete event modal-->
@endsection
@push("js")
<script>
    $(document).ready(function () {
        eventFormatCurrency();
    });
    function handleLoadData(event,type,id) {
        $.ajax({
            type: "get",
            url: "{{route('admin.api.administrative-units')}}",
            data: {type, value:$(event.target).val()},
            dataType: "json",
            success: function (response) {
                let htmlResponse = `<option value="">Lựa chọn</option>`;
                $.each(response, function( key, data ) {
                    htmlResponse += `<option value="${data.id}">${data.name}</option>`;
                });
                $(id).html(htmlResponse);
            }
        });
    }
</script>
@endpush
@push("js")
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        showTimeCalendar();
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'local',
            events:fetchEvents(),
            headerToolbar: {
            start: '',
            end: ''
            },
            initialView: 'timeGridWeek',
            validRange: { // Cụ thể một lịch trong tuần để show ra các lịch dạy các thứ trong tuần, lịch ngày thì không phải quan tâm
                start: '2023-03-19',
                end: '2023-03-26'
            },
            slotLabelFormat:
                {
                hour: 'numeric',
                minute: '2-digit',
                omitZeroMinute: false,
                hour12: false
                },
            dateClick: function(info) {
                var date = moment(info.date).format('YYYY-MM-DD');
                var day = moment(info.date).format('ddd');
                var time = moment(info.date).format('H:mm');
                $(".add-event-btn").removeClass("d-none");
                $(".update-event-btn").addClass("d-none");
                $(".btn-delete-event").addClass("d-none");
                $("#calendar_id").val("");
                $(".date_class").val(date);
                $("#day_class_register").val(day);
                $("#start_time").val(time);
                $("#end_time").val(time);
                showTimeCalendar();
                $(".modal-title").html("Thêm lịch dạy cho lớp học");
                $("#add-new-sidebar").modal('show');
            },
            eventClick: function (event, jsEvent, view) {
                const idCalendar = event.event.id;
                const date = moment(event.event.start).format('YYYY-MM-DD');
                var day = moment(event.event.start).format('ddd');
                const startTime = moment(event.event.start).format('H:mm');
                const endTime = moment(event.event.end).format('H:mm');
                $(".add-event-btn").addClass("d-none");
                $(".update-event-btn").removeClass("d-none");
                $(".btn-delete-event").removeClass("d-none");
                $("#calendar_id").val(idCalendar);
                $(".date_class").val(date);
                $("#day_class_register").val(day);
                $("#start_time").val(startTime);
                $("#end_time").val(endTime);
                showTimeCalendar();
                $(".modal-title").html("Cập nhật lịch dạy cho lớp học");
                $("#add-new-sidebar").modal('show');
            },
            viewDidMount: function(event, element) {
            $('.fc-col-header-cell').each(function() {
                const headerShowDay = $(this).children().children();
                const textHeader = headerShowDay.html().slice(0,3);
                headerShowDay.html(textHeader);
            });
        },
        });
        let count = 1;
        $(".add-calendar-register-class").click(function() {
            if(count == 1) calendar.render();
            count++;
        })
        $('#form-calendar-register').validate({
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        toastr['success'](response.message, { showDuration: 300, rtl: false });
                        $("#add-new-sidebar").modal('hide');
                        var newEvent = {
                            id: response.data.id,
                            start: response.data.date + " " + response.data.start_time,
                            end: response.data.date + " " + response.data.end_time
                        }
                        if(!$("#calendar_id").val()) {
                            calendar.addEvent(newEvent);
                        } else updateEventInCalendar(newEvent, ["id","start","end"]);
                    },
                    error: function(error){
                        toastr['error'](error.message, { showDuration: 300, rtl: false });
                    }
                });
            }
        });
        $(".btn-delete-event").click(function() {
            const idCalendar = $("#calendar_id").val();
            $.ajax({
                type: "DELETE",
                url: "/admin/api/classes-register/calendar/"+idCalendar+"/delete",
                data: "data",
                dataType: "json",
                success: function (response) {
                    toastr['success'](response.message, { showDuration: 300, rtl: false });
                    $("#add-new-sidebar").modal('hide');
                    calendar.getEventById(idCalendar).remove();
                },
                error: function(error){
                    console.log(error);
                    toastr['error'](error.message, { showDuration: 300, rtl: false });
                }
            });
        })
        function fetchEvents() {
            // Fetch Events from API endpoint reference
            var calendars = [];
            var response = $.ajax({
                url: "{{ route('admin.api.calendar.events', $classRegister->id) }}",
                data: {model:"CLASS_REGISTER"},
                type: 'GET',
                async: false,
                dataType:"JSON",
            });
            if(response.status == 200) {
                calendars = response.responseJSON.data;
            }
            return calendars;
        }
        const updateEventInCalendar = (updatedEventData, propsToUpdate) => {
        const existingEvent = calendar.getEventById(updatedEventData.id);
        for (var index = 0; index < propsToUpdate.length; index++) {
        var propName = propsToUpdate[index];
        existingEvent.setProp(propName, updatedEventData[propName]);
        }
        existingEvent.setDates(updatedEventData.start, updatedEventData.end, { allDay: updatedEventData.allDay });
        };
      });
      function showTimeCalendar() {
        $(".time_flatpickr").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        });
      }
      function reloadPage() {
        setTimeout(() => {
            location.reload();
        }, 2000);
      }
</script>
@endpush


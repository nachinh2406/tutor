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
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============== Candidate Dashboard ====================== -->
         <!-- Calendar Add/Update/Delete event modal-->
         <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
            <div class="modal-dialog sidebar-lg">
                <div class="modal-content p-0">
                    <div class="modal-header mb-1">
                        <h5 class="modal-title"></h5>
                    </div>
                    <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                        <form class="event-form needs-validation" data-ajax="false" novalidate id="form-calendar-register" method="post" action="{{route("profile.calendar.update")}}">
                           @csrf
                            <input type="hidden" class="date_class" name="date_class" id="date_class">
                            <input type="hidden" class="calendar_id" name="calendar_id" id="calendar_id">
                            <div class="mb-1">
                                <label for="day_user" class="form-label">Thứ</label>
                                <select class="select2 day_user form-select w-100" id="day_user" name="day_user">
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
                                <button type="submit" class="btn btn-primary update-event-btn d-none me-1 ml-1">Cập nhật</button>
                                <button type="button" class="btn btn-outline-danger btn-delete-event d-none mr-4 ml-4">Xóa</button>
                                <button type="button" class="btn btn-outline-secondary btn-cancel" onclick="$('#add-new-sidebar').modal('hide')">Đóng</button>
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
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script src="{{asset("frontend/js/profile.calendar.js")}}"></script>
@endpush

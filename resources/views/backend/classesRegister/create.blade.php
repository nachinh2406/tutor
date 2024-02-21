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
                        <h2 class="content-header-title float-start mb-0">Đăng ký lớp mới</h2>
                        {{Breadcrumbs::render('classes-register.create')}}
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
                            <div class="card-header">
                                <h4 class="card-title">Đăng ký lớp mới</h4>
                            </div>
                            <div class="card-body">

                                <form method="POST" action="{{route("admin.classes-register.store")}}" class="needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="class_id">Lớp đăng ký</label>
                                                <select class="form-select" id="class_id" name="class_id" required>
                                                    <option value="">Lựa chọn</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{$class->id}}">{{$class->name_class}}</option>
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
                                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="scope_class">Phạm vi lớp</label>
                                                <input type="text" name="scope_class" id="scope_class" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="role_user">Nhúng Google map</label>
                                                <input type="text" name="embed_map" id="embed_map" class="form-control"  />
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
                                                        <option value="{{$province->id}}">{{$province->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="district_id">Quận huyện</label>
                                                <select class="form-select" id="district_id" onchange="handleLoadData(event,2,'#ward_id')" name="district_id" required>
                                                    <option value="">Lựa chọn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="ward_id">Xã Phường</label>
                                                <select class="form-select" id="ward_id" name="ward_id" required>
                                                    <option value="">Lựa chọn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="gender_request">Yêu cầu giới tính</label>
                                                <select class="form-select" name="gender_request" id="gender_request" required>
                                                    <option value="1">Nam</option>
                                                    <option value="2">Nữ</option>
                                                    <option value="3">Khác</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="price_class">Giá lớp</label>
                                                <input type="text" name="price_class" id="price_class" class="form-control format_number" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="number_lesson_week">Số buổi / tuần</label>
                                                <input type="text" name="number_lesson_week" id="number_lesson_week" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="fee__percentage_class">Phí lớp</label>
                                                <input type="text" name="fee__percentage_class" id="fee__percentage_class" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="role_user">Yêu cầu người dạy</label>
                                                <select class="form-select" name="role_user" id="role_user">
                                                <option value="">Lựa chọn</option>
                                                @foreach (ROLE_USER as $key=>$gender)
                                                    <option value="{{$key}}">{{$gender}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="request_class">Yêu cầu lớp</label>
                                                <textarea name="request_class" id="request_class" rows="20"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="student_note">Đặc điểm học sinh</label>
                                                <textarea name="student_note" id="student_note" rows="20"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="is_experienced" name="is_experienced" value="1" checked="">
                                                <label class="form-check-label" for="is_experienced" >Yêu cầu kinh nghiệm</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="is_university_top" name="is_university_top" value="1" checked="">
                                                <label class="form-check-label" for="is_university_top" >Yêu cầu SV trường TOP</label>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </form>
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

@extends("backend.layouts.master")
@section("content")
<style>
    .width-35 {
        width: 40%;
    }
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Danh sách gia sư</h2>
                        {{Breadcrumbs::render('users.index')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic table -->
            <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <table class="datatables-basic table">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Giới tính</th>
                                        <th>Vai trò</th>
                                        <th>Trường</th>
                                        <th>Ngành</th>
                                        <th>Vinh danh</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Basic table -->
        </div>
    </div>
</div>
<div class="modal fade text-start" id="info_user" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title_user"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home" aria-expanded="true">Thông tin chi tiết gia sư</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#profile" aria-expanded="false">Danh sách lớp được giao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="card-tab" data-bs-toggle="pill" href="#card-identify" aria-expanded="false">Hồ sơ xác minh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="calendar-tab" data-bs-toggle="pill" href="#calendar" aria-expanded="false">Lịch dạy</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-1">
                                    <span  ><b>Họ và tên:</b></span>
                                    <span class="name_info"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Email:</b></span>
                                    <span class="email_info" ></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Số điện thoại:</b></span>
                                    <span class="phone_info"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Giới tính:</b></span>
                                    <span class="gender_info"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Ngày sinh:</b></span>
                                    <span class="born_info"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Trường học:</b></span>
                                    <span class="info_school"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-1">
                                    <span><b>Ngành học:</b></span>
                                    <span class="info_major"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Thời gian bắt đầu:</b></span>
                                    <span class="info_start_from"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Thời gian kết thúc:</b></span>
                                    <span class="info_end_from"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Vị trí:</b></span>
                                    <span class="info_position"></span>
                                </div>
                                <div class="mb-1">
                                    <span  ><b>Kinh nghiệm:</b></span>
                                    <span class="info_experience"></span>
                                </div>
                                <div class="mb-1">
                                    <span><b>Cảm nhận gia sư về trung tâm:</b></span>
                                    <span class="comment"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                        <div class="card-header">
                            <h4 class="card-title">Dách sách lớp từng nhận</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Tên lớp</th>
                                        <th>Giá lớp</th>
                                        <th>Phí lớp</th>
                                        <th>Số buổi / tuần</th>
                                        <th>Hợp đồng</th>
                                        <th>Thời gian nhận lớp</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="classAssigned">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="card-identify" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                        <div class="card-header">
                            <h4 class="card-title">Căn cước công dân</h4>
                            <form action="">
                             <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="number_card">Số CCCD/CMND</label>
                                        <input type="text" disabled id="number_card" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="date_card">Ngày đăng ký</label>
                                        <input type="text" disabled id="date_card" class="form-control" />
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="expire_card">Ngày hết hạn</label>
                                        <input type="text" disabled id="expire_card" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="address">Nơi đăng ký</label>
                                        <input type="text" disabled id="address" class="form-control" />
                                    </div>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="photo_before">Ảnh mặt trước</label>
                                        <div class="photo_before"><img width="300" height="150" src="" alt=""></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-1">
                                        <label class="form-label" for="photo_after">Ảnh mặt sau</label>
                                        <div class="photo_after"><img width="300" height="150" src="" alt=""></div>
                                    </div>
                                </div>
                             </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="calendar" role="tabpanel" aria-labelledby="profile-tab" aria-expanded="false">
                        <div class="card-header">
                            <h4 class="card-title">Lịch dạy gia sư</h4>
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
    <script src="{{asset("backend/js/user-index.js?v=").rand(0,10)}}"></script>
@endpush

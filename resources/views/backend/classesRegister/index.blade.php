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
                        <h2 class="content-header-title float-start mb-0">Lớp đăng ký</h2>
                        {{Breadcrumbs::render('classes-register.index')}}
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
                                        <th>Mã lớp</th>
                                        <th>Tên lớp đăng ký</th>
                                        <th>Giá lớp / Tháng</th>
                                        <th>Phí lớp</th>
                                        <th>Số buổi / tuần</th>
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
<div class="modal fade" id="assignClassRegister" tabindex="-1" aria-labelledby="assignClassRegisterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-4">
                <h1 class="text-center mb-1" id="assignClassRegisterTitle">Giao lớp</h1>
                <p class="text-center">Giao lớp cho đội ngũ gia sư</p>
                <form action="" method="POST" id="form-assign">
                    @csrf
                    <input type="hidden" name="class_id" id="class_id">
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="addMemberSelect">Chọn gia sư</label>
                        <select required class="select2 form-select" name="user_id" id="addMemberSelect">
                        </select>
                    </div>
                    <div class="mb-1">
                    <label class="form-label fw-bolder font-size font-small-4 mb-50" for="addMemberSelect">Chọn hợp đồng phù hợp</label>
                        <select required class="select2 form-select" name="contract_id" id="contractId">
                            <option value="">--- Lựa chọn hợp đồng ---</option>
                            @foreach ($contracts as $contract)
                                <option value="{{$contract->id}}">{{$contract->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12" style="text-align: right;">
                        <button type="submit" class="btn btn-primary me-1 mt-1 waves-effect waves-float waves-light">Giao lớp ngay</button>
                    </div>
                </form>

                <p class="fw-bolder pt-50 mt-2">Tất cả các gia sư</p>

                <!-- member's list  -->
                <ul class="list-group list-group-flush mb-2">

                </ul>
                <!--/ member's list  -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-start" id="listAssignedUsers" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleAssign"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Gia sư</th>
                                <th>Email</th>
                                <th>Trường</th>
                                <th>Ngành</th>
                                <th>Vai trò</th>
                                <th>Hợp đồng</th>
                                <th>Thời gian nhận lớp</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody id="UserAssigned">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade text-start" id="listFilterUsers" tabindex="-1" aria-labelledby="myModalLabel18" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleFilter"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Gia sư</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Trường</th>
                                <th>Ngành</th>
                                <th>Vai trò</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="FilterUsers">

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
    <script src="{{asset("backend/app-assets/js/scripts/tables/table-datatables-basic.js?v=r").rand(0,10)}}"></script>
@endpush

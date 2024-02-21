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
                        <h2 class="content-header-title float-start mb-0">Danh sách admins</h2>
                        {{Breadcrumbs::render('admins.index')}}
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
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
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
<div class="modal fade" id="modal_admin" tabindex="-1" aria-labelledby="assignClassRegisterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 mx-50 pb-4">
                <h1 class="text-center mb-1" id="adminTitle">Thêm thành viên</h1>
                <form action="" method="POST" id="form-admin">
                    @csrf
                    <input type="hidden" name="admin_id" id="admin_id">
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="name">Tên đầy đủ</label>
                        <input type="text" class="form-control" name="name" id="name" >
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="phone">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" id="phone" >
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" >
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="password">Mật khẩu</label>
                        <input type="password" class="form-control" name="password" id="password" >
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="password_confirmation">Nhập lại khẩu</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-bolder font-size font-small-4 mb-50" for="roles">Phân quyền</label>
                        <select  class="select2 form-select" multiple name="roles[]" id="roles">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12" style="text-align: right;">
                        <button type="submit" class="btn btn-primary me-1 mt-1 waves-effect waves-float waves-light">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push("js")
    <script src="{{asset("backend/js/admin-index.js?v=r").rand(0,10)}}"></script>
@endpush

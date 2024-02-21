@extends("backend.layouts.master")
@section("content")
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <h3>Danh sách vai trò</h3>
                <!-- Role cards -->
                <div class="row">
                    @foreach ($roles as $role)
                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <span>Tổng {{$role->admins_count}} thành viên</span>
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        {{-- <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                                            <img class="rounded-circle" src="../../../app-assets/images/avatars/4.png" alt="Avatar" />
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                    <div class="role-heading">
                                        <h4 class="fw-bolder">{{$role->name}}</h4>
                                        <a href="javascript:;" class="role-edit-modal" onclick="handleEditRole({{$role->id}}, '{{$role->name}}')">
                                            <small class="fw-bolder">Chỉnh sửa</small>
                                        </a>
                                    </div>
                                    <a href="javascript:void(0);" onclick="handleDeleteRole({{$role->id}})" class="text-body"><i data-feather="delete" class="font-medium-5"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-xl-4 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="d-flex align-items-end justify-content-center h-100">
                                        <img src="{{asset("backend/app-assets/images/illustration/faq-illustrations.svg")}}" class="img-fluid mt-2" alt="Image" width="85" />
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="card-body text-sm-end text-center ps-sm-0">
                                        <a href="javascript:void(0)" class="stretched-link text-nowrap add-new-role">
                                            <span class="btn btn-primary mb-1">Thêm vai trò</span>
                                        </a>
                                        <p class="mb-0">Thêm vai trò nếu chưa tồn tại</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Role cards -->
                <!-- Add Role Modal -->
                <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5 pb-5">
                                <div class="text-center mb-4">
                                    <h1 class="role-title">Thềm vai trò</h1>
                                    <p>Cài đặt quyền hạn</p>
                                </div>
                                <!-- Add role form -->
                                <form id="addRoleForm" method="post" action="{{route("admin.roles.store")}}" class="row">
                                    @csrf
                                    <div class="col-12">
                                        <label class="form-label" for="name">Tên vai trò</label>
                                        <input type="text" id="name" name="name" class="form-control"  tabindex="-1" data-msg="Yêu cầu bắt buộc" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="description">Mô tả vai trò</label>
                                        <input type="text" id="description" name="description" class="form-control"  tabindex="-1" data-msg="Yêu cầu bắt buộc" />
                                    </div>
                                    <div class="col-12">
                                        <h4 class="mt-2 pt-50">Quyền hạn</h4>
                                        <!-- Permission table -->
                                        <div class="table-responsive">
                                            <table class="table table-flush-spacing">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-nowrap fw-bolder">

                                                        </td>
                                                        <td>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                                                <label class="form-check-label" for="selectAll">Chọn tất cả</label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                        @foreach ($permissions as $permission)
                                                        <tr>
                                                        <td class="text-nowrap fw-bolder">{{$permission->name}}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                @foreach ($permission->childPermission as $childPermission)
                                                                <div class="form-check me-3 me-lg-5">
                                                                    <input class="form-check-input role-checkbox" type="checkbox" data-id="{{$childPermission->id}}" name="roles[]" value="{{$childPermission->id}}" id="role-{{$childPermission->id}}" />
                                                                    <label class="form-check-label" for="role-{{$childPermission->id}}"> {{$childPermission->name}}</label>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                        </tr>
                                                        @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Permission table -->
                                    </div>
                                    <div class="col-12 text-center mt-2">
                                        <button type="submit" class="btn btn-primary me-1">Cập nhật</button>
                                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            Đóng
                                        </button>
                                    </div>
                                </form>
                                <!--/ Add role form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Add Role Modal -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@push("js")
    <script src="{{asset("backend/js/roles-index.js?v=r").rand(0,10)}}"></script>
@endpush

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
                        <h2 class="content-header-title float-start mb-0">Thêm mới môn học</h2>
                        {{Breadcrumbs::render('subjects.create')}}
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
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
                                <h4 class="card-title">Thêm môn học</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{route("admin.subjects.store")}}" class="needs-validation" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="name">Tên môn học</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required />
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="category_subject_id">Loại sách</label>
                                        <select class="form-select select2" id="category_subject_id" name="category_subject_id" required>
                                            @foreach ($subjectCategories as $subjectCategory)
                                                <option value="{{$subjectCategory->id}}">{{$subjectCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1">
                                        <label class="form-label" for="status">Trạng thái</label>
                                        <select class="form-select" name="status" id="status" required>
                                            <option value="0">Chưa kích hoạt</option>
                                            <option value="1">Kích hoạt</option>
                                        </select>
                                    </div>
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
@push('js')
    <script>
        $(".select2").select2();
    </script>
@endpush


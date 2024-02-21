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
                        <h2 class="content-header-title float-start mb-0">Khối học</h2>
                        {{Breadcrumbs::render('classes-register.index')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic Tables start -->
            <div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route("admin.classes.create")}}" class="btn btn-primary float-right">Thêm mới</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên khối học</th>
                                        <th>Cấp học học</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($classes as $class)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{$class->id}}</span>
                                        </td>
                                        <td>{{$class->name_class}}</td>
                                        <td>{{$class->level_class_custom}}</td>
                                        <td class="text-center">
                                           <a href="{{route("admin.classes.edit",$class->id)}}"><span class=""><i data-feather='edit'></i></span></a>
                                           <a href="javascript:void(0);"
                                            onclick="if (confirm('Are you sure to delete this record?'))
                                            {document.getElementById('delete-class-{{ $class->id }}').submit();} else {return false;}"
                                            class="">
                                            <span class=""><i data-feather='trash'></i></span>
                                            </a>
                                           <form action="{{ route('admin.classes.destroy', $class) }}"
                                                method="POST"
                                                id="delete-class-{{ $class->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Tables end -->
        </div>
    </div>
</div>
@endsection


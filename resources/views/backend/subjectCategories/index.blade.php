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
                        <h2 class="content-header-title float-start mb-0">Danh mục môn học</h2>
                        {{Breadcrumbs::render('subject-categories.index')}}
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
                            <a href="{{route("admin.subject-categories.create")}}" class="btn btn-primary float-right">Thêm mới</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Danh mục sách</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subjectCategories as $subjectCategory)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{$subjectCategory->id}}</span>
                                        </td>
                                        <td>{{$subjectCategory->name}}</td>
                                        <td>{!! $subjectCategory->status_custom !!}</td>
                                        <td class="text-center">
                                           <a href="{{route("admin.subject-categories.edit",$subjectCategory->id)}}"><span class=""><i data-feather='edit'></i></span></a>
                                           <a href="javascript:void(0);"
                                            onclick="if (confirm('Are you sure to delete this record?'))
                                            {document.getElementById('delete-subject-category-{{ $subjectCategory->id }}').submit();} else {return false;}"
                                            class="">
                                            <span class=""><i data-feather='trash'></i></span>
                                            </a>
                                           <form action="{{ route('admin.subject-categories.destroy', $subjectCategory) }}"
                                                method="POST"
                                                id="delete-subject-category-{{ $subjectCategory->id }}" class="d-none">
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

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
                        <h2 class="content-header-title float-start mb-0">Môn học</h2>
                        {{Breadcrumbs::render('subjects.index')}}
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
                            <a href="{{route("admin.subjects.create")}}" class="btn btn-primary float-right">Thêm mới</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên môn học</th>
                                        <th>Loại môn học</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($subjects as $subject)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{$subject->id}}</span>
                                        </td>
                                        <td>{{$subject->name}}</td>
                                        <td>{{optional($subject->category)->name}}</td>
                                        <td>{!! $subject->status_custom !!}</td>
                                        <td class="text-center">
                                           <a href="{{route("admin.subjects.edit",$subject->id)}}"><span class=""><i data-feather='edit'></i></span></a>
                                           <a href="javascript:void(0);"
                                            onclick="if (confirm('Are you sure to delete this record?'))
                                            {document.getElementById('delete-subject-{{ $subject->id }}').submit();} else {return false;}"
                                            class="">
                                            <span class=""><i data-feather='trash'></i></span>
                                            </a>
                                           <form action="{{ route('admin.subjects.destroy', $subject) }}"
                                                method="POST"
                                                id="delete-subject-{{ $subject->id }}" class="d-none">
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


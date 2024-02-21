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
                        <h2 class="content-header-title float-start mb-0">Hợp đồng</h2>
                        {{Breadcrumbs::render('contracts.index')}}
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
                            <a href="{{route("admin.contracts.create")}}" class="btn btn-primary float-right">Thêm mới</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã hợp đồng</th>
                                        <th>Tên hợp đồng</th>
                                        <th>Loại hợp đồng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contracts as $contract)
                                    <tr>
                                        <td>
                                            <span class="fw-bold">{{$contract->id}}</span>
                                        </td>
                                        <td>{{$contract->code}}</td>
                                        <td>{{$contract->title}}</td>
                                        <td>{{$contract->type_custom}}</td>
                                        <td>{!! $contract->status_custom !!}</td>
                                        <td>{{$contract->created_at_custom}}</td>
                                        <td class="text-center">
                                           <a href="{{route("admin.contracts.edit",$contract->id)}}"><span class=""><i data-feather='edit'></i></span></a>
                                           <a href="javascript:void(0);"
                                            onclick="if (confirm('Are you sure to delete this record?'))
                                            {document.getElementById('delete-contract-{{ $contract->id }}').submit();} else {return false;}"
                                            class="">
                                            <span class=""><i data-feather='trash'></i></span>
                                            </a>
                                           <form action="{{ route('admin.contracts.destroy', $contract) }}"
                                                method="POST"
                                                id="delete-contract-{{ $contract->id }}" class="d-none">
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

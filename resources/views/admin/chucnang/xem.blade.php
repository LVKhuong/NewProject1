@extends('admin.layouts.index')

@section('timkiem')
    <form method="get" action="{{ route('chucnang.index') }}"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input type="text" name="keySearch" class="form-control bg-light border-0 small" placeholder="Tìm kiếm"
                aria-label="Search" name="TimKiem" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chức năng người dùng</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Tên người dùng</th>
                            <th>Email login</th>
                            <th>Quyền</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value)
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->role->ten_role ?? 'Chưa cấp quyền' }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    <a href="{{ route('chucnang.edit', $value->id) }}"
                                        class="btn btn-sm btn-success">Sửa</a>
                                    <a href="{{ route('chucnang.show', $value->id) }}" class="btn btn-sm btn-primary">Xem
                                        chức năng</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ml-3">
            {!! $data->links() !!}
        </div>
    </div>
@endsection

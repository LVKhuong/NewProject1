@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm menu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                @if (session('thongbao'))
                    <div class="alert alert-success">
                        {{ session('thongbao') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger small">
                        @foreach ($errors->all() as $value)
                            {{ $value }}<br>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('chucnang.menu_store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-prepend mr-3">
                            <span class="input-group-text" id="basic-addon3">Chọn quyền user</span>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio1"
                                value="1,Quản lí sản phẩm">
                            <label class="form-check-label" for="inlineRadio1">Quản lí sản phẩm (1) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio2"
                                value="2,Quản lí người dùng">
                            <label class="form-check-label" for="inlineRadio2">Quản lí người dùng (2) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="3,Quản lí đơn hàng">
                            <label class="form-check-label" for="inlineRadio3">Quản lí đơn hàng (3) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="4,Quản lí thương hiệu">
                            <label class="form-check-label" for="inlineRadio3">Quản lí thương hiệu (4) </label>
                        </div>
                        <div class="form-check form-check-inline ml-3">
                            <input class="form-check-input" type="radio" name="role" id="inlineRadio3"
                                value="5,Quản lí danh mục">
                            <label class="form-check-label" for="inlineRadio3">Quản lí danh mục (5) </label>
                        </div>
                    </div>

                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID </th>
                                <th>Tên</th>
                                <th>Email login</th>
                                <th>Ảnh đại diện</th>
                                <th>Chọn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 0; ?>
                            @foreach ($users as $value)
                                <tr>
                                    <td>{{ ++$stt }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>
                                        @if (isset($value->image->duongdan))
                                            <img src="{{ $value->image->duongdan }}" alt=""
                                                style="width: 50px; height: 50px;">
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="user" id="inlineRadio1"
                                                value="{{ $value->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <div class="mt-3">
                            {!! $users->links() !!}
                        </div>
                    </table>

                    <a href="{{ route('chucnang.menu_index') }}" class="btn btn-primary">Về lại danh sách </a>
                    <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
                </form>

            </div>
        </div>

    </div>
@endsection

@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Màu sắc</h6>
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
                            <th>STT</th>
                            <th>ID</th>
                            <th>Tên màu sắc</th>
                            <th>Tên sản phẩm</th>
                            <th>Size</th>
                            <th>Tổng số lượng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($size_tongsoluongs as $value)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->mausac->ten }}</td>
                                <td>{{ $value->mausac->sanpham->ten }}</td>
                                <td>{{ $value->size }}</td>
                                <td>{{ $value->tongsoluong }}</td>
                                <td>
                                    <form action="{{ route('size_tongsoluong.destroy', $value->id) }}" method="POST">
                                        @csrf @method('DELETE')

                                        <input type="submit" value="Xóa" class="btn btn-sm btn-danger">

                                        <a href="{{ route('size_tongsoluong.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary">Sửa</a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ml-3">
            {!! $size_tongsoluongs->links() !!}
        </div>
    </div>
@endsection

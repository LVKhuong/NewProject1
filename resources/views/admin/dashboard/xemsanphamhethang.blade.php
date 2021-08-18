@extends('admin.layouts.index')

@section('noidung')
    <h4>SẢN PHẨM HẾT HÀNG</h4>
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
            @foreach ($data as $value)
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
@endsection

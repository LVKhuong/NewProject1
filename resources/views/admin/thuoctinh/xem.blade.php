@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thuộc tính</h6>
        </div>
        <div class="card-body ">
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
                            <th>ID </th>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Hình ảnh màu sắc</th>
                            <th>Size</th>
                            <th>Số lượng</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($data as $value)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->sanpham->ten ?? '' }}</td>
                                <td>{{ $value->mausac }}</td>
                                <td>
                                    <img src="{{ $value->image->duongdan ?? '' }}" alt="" style="width: 50px">
                                </td>
                                <td>{{ $value->size }}</td>
                                <td>{{ $value->soluong }}</td>
                                <td>
                                    <form action="{{ route('thuoctinh.destroy', $value->id) }}" method="POST">
                                        @csrf @method('DELETE')

                                        <a href="{{ route('thuoctinh.edit', $value->id) }}"
                                            class="btn btn-sm btn-primary">Sửa</a>
                                        <input type="submit" value="Xóa" class="btn btn-sm btn-danger">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div>
        {!! $data->links() !!}
    </div>
@endsection

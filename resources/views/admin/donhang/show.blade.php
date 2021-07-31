@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
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
                            <th>Tên sản phẩm</th>
                            <th>Ngày mua</th>
                            <th>Giá</th>
                            <th>Số lượng</th> 
                            <th>Thành tiền</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($data as $value)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $value->sanpham->ten }}</td>
                                <td>{{ $value->created_at}}</td>
                                <td>{{ number_format($value->gia) }}</td>
                                <td>{{ $value->soluong }}</td>
                                <td>{{ number_format($value->thanhtien) }}</td>
                                <td>
                                    <div>
                                        <form action="{{ route('chitietdonhang.destroy', $value->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <input type="submit" value="Xóa" class="btn btn-sm btn-danger">
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

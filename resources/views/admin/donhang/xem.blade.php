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
                            <th>Người mua </th>
                            <th>Ngày mua</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($data as $value)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $value->nguoimua }}</td>
                                <td>{{ $value->ngaymua }}</td>
                                <td>{{ number_format($value->tongtien) }}</td>
                                <td>{{ $value->trangthai }}</td>
                                <td>
                                    <div>
                                        <form action="{{ route('donhang.destroy', $value->id) }}" method="POST">
                                            @csrf @method('DELETE')

                                            <input type="submit" value="Xóa" class="btn btn-sm btn-danger">
                                            <a href="{{ route('donhang.show', $value->id) }}"
                                                class="btn btn-sm btn-success">Chi tiết</a>
                                            <a href="{{ route('send.Mail', $value->id) }}"
                                                class="btn btn-sm btn-primary">Gửi Mail</a>
                                        </form>

                                    </div>
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

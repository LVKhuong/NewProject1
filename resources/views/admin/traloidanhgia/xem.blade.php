@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Trả lời bình luận</h6>
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
                            <th>ID người dùng</th>
                            <th>Tên người bình luận</th>
                            <th>Email người bình luận</th>
                            <th>Nội dung bình luận</th>
                            <th>Sao</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($danhgias as $danhgia)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $danhgia->sanpham->ten }}</td>
                                <td>{{ $danhgia->id_user ?? 'Không đăng nhập' }}</td>
                                <td>{{ $danhgia->name }}</td>
                                <td>{{ $danhgia->email }}</td>
                                <td>{{ $danhgia->noidung }}</td>
                                <td>{{ $danhgia->sao }}</td>
                                <td>
                                    <a href="{{route('traloi.create', $danhgia->id)}}" class="btn btn-primary">Trả lời</a>
                                    <a href="{{route('traloi.show', $danhgia->id)}}" class="btn btn-success">Xem trả lời</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="ml-3">
            {!! $danhgias->links() !!}
        </div>
    </div>
@endsection

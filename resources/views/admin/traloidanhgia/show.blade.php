@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Trả lời</h6>
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
                            <th>Tên người trả lời</th>
                            <th>Email người trả lời</th>
                            <th>Quyền</th>
                            <th>Nội dung trả lời</th>
                            <th>Tên sản phẩm</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0;?>
                        @foreach ($tralois as $traloi)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $traloi->user->name }}</td>
                                <td>{{ $traloi->user->email }}</td>
                                <td>{{ $traloi->user->role->ten_role ?? 'Không có quyền' }}</td>
                                <td>{{ $traloi->noidung }}</td>
                                <td>{{ $traloi->danhgia->sanpham->ten }}</td>
                                <td>
                                    <form action="{{ route('traloi.destroy', $traloi->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <a href="{{route('traloi.edit', $traloi->id)}}"
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

        <div class="ml-3">
            {!! $tralois->links() !!}
        </div>
    </div>
@endsection

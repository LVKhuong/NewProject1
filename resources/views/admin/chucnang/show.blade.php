@extends('admin.layouts.index')

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
                            <th>STT</th>
                            <th>Quyền Route</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $stt = 0; ?>
                        @foreach ($chucNangs as $chucNang)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $chucNang->tenroute }}</td>
                                <td>
                                    <form action="{{ route('chucnang.destroy', $chucNang->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <input type="submit" value="Xóa" class="btn btn-sm btn-danger">
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="ml-3">
            {!! $chucNangs->links() !!}
        </div> --}}
    </div>
@endsection

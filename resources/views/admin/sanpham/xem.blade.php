@extends('admin.layouts.index')

@section('timkiem')
    <div>
        <form method="get" action="{{ route('sanpham.index') }}"
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
    </div>

    <div class="form-check form-check-inline">
        <form action="{{ route('sanpham.index') }}" method="get" id="new">
            <input class="form-check-input" {{ isset($_GET['isNew']) ? 'checked' : '' }} onclick="$('#new').submit();"
                type="checkbox" name="isNew" id="inlineCheckbox1" value="1">
        </form>
        <label class="form-check-label" for="inlineCheckbox1">New</label>
    </div>


    <div class="form-check form-check-inline">
        <form action="{{ route('sanpham.index') }}" method="get" id="hot">
            <input class="form-check-input" {{ isset($_GET['isHot']) ? 'checked' : '' }} onclick="$('#hot').submit();"
                type="checkbox" name="isHot" id="inlineCheckbox2" value="1">
        </form>
        <label class="form-check-label" for="inlineCheckbox2">Hot</label>
    </div>

    <div class="form-check form-check-inline">
        <form action="{{ route('sanpham.index') }}" method="get" id="sale">
            <input class="form-check-input" {{ isset($_GET['sale']) ? 'checked' : '' }} onclick="$('#sale').submit();"
                type="checkbox" name="sale" id="inlineCheckbox3" value="1">
        </form>
        <label class="form-check-label" for="inlineCheckbox3">Sale</label>
    </div>

@endsection

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="quanli/sanpham" class="m-0 font-weight-bold text-primary">Tất cả sản phẩm</a>
        </div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="table-responsive">

                    @if (session('thongbao'))
                        <div class="alert alert-success">
                            {{ session('thongbao') }}
                        </div>
                    @endif

                    <form action="{{ route('import.sanpham.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="btn btn-primary" type="file" name="excel">
                        <input class="btn btn-primary" type="submit" value="Tải file Excel">
                        <a class="btn btn-success" href="quanli/export/sanpham">Export Excel</a>
                    </form>

                    <table class="table table-bordered text-center m-0 mt-3" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Đơn giá</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th>Hot</th>
                                <th>New</th>
                                <th>Sale (%)</th>
                                <th>Gía sale</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $stt = 0; ?>
                            @foreach ($data as $value)
                                <tr>
                                    <td>{{ ++$stt }}</td>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->ten }}</td>
                                    <td>
                                        @foreach ($value->images as $image)
                                            <img src="{{ $image->duongdan }}" style="width: 50px; height:50px;" alt="">
                                        @endforeach
                                    </td>
                                    <td>{{ number_format($value->gia) }}</td>
                                    <td>{{ $value->chungloai->ten ?? '' }}</td>
                                    <td>{{ $value->thuonghieu->ten ?? '' }}</td>
                                    <td>{{ $value->isHot == 1 ? 'Có' : 'Không' }}</td>
                                    <td>{{ $value->isNew == 1 ? 'Có' : 'Không' }}</td>
                                    <td>{{ $value->sale }}</td>
                                    <td>{{ number_format($value->gia - ($value->gia * $value->sale) / 100) }}</td>
                                    <td>
                                        <form action="{{ route('sanpham.destroy', $value->id) }}" method="POST">
                                            @csrf @method('DELETE')

                                            <a href="{{ route('sanpham.edit', $value->id) }}"
                                                class="btn btn-sm btn-success">Sửa</a>

                                            <input type="submit" value="Xóa" class="btn btn-sm btn-danger">

                                            <a href="{{ route('sanpham.giamgia.create', ['idsanpham' => $value->id]) }}"
                                                class="btn btn-sm btn-success">Thêm giảm
                                                giá
                                            </a>

                                            <a href="{{ route('mausac.create', $value->id) }}" class="btn btn-sm btn-primary mt-3">Thêm
                                                màu sắc
                                            </a>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ml-3">
            {{ $data->links() }}
        </div>
    </div>

@endsection

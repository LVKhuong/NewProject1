@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">THÊM MỚI THUỘC TÍNH</h6>

        </div>

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

        <!-- Card Body -->
        <div class="card-body">
            <form action="{{ route('thuoctinh.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend ">
                            <span class="input-group-text" id="basic-addon3">Nhập màu sắc </span>
                        </div>
                        <input type="text" class="form-control" id="basic-url" name="mausac" value="{{ old('mausac') }}"
                            aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon3">Nhập size </span>
                        </div>
                        <div class="row">
                            @for ($i = 28; $i <= 45; $i++)
                                <div class="form-check form-check-inline col-sm-2">
                                    <input class="form-check-input" type="checkbox" name="size[]" id="inlineCheckbox1"
                                        value="{{ $i }}">
                                    <label class="form-check-label" for="inlineCheckbox1">{{ $i }}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="input-group mb-3 col-sm-4">
                        <div class="input-group-prepend ">
                            <span class="input-group-text" id="basic-addon3">Nhập số lượng </span>
                        </div>
                        <input type="number" class="form-control" id="basic-url" name="soluong"
                            value="{{ old('soluong') }}" aria-describedby="basic-addon3">
                    </div>
                    <div class="input-group mb-3 col-sm-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon5">Tải ảnh màu sắc</span>
                            <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="file_mausac"
                                aria-describedby="basic-addon5" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table class="table table-bordered text-center m-0 mt-3" id="dataTable" width="100%"
                            cellspacing="0">
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
                                    <th>Chọn</th>
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
                                                <img src="{{ $image->duongdan }}" style="width: 50px; height:50px;"
                                                    alt="">
                                            @endforeach
                                        </td>
                                        <td>{{ number_format($value->gia) }}</td>
                                        <td>{{ $value->chungloai->ten }}</td>
                                        <td>{{ $value->thuonghieu->ten }}</td>
                                        <td>{{ $value->isHot == 1 ? 'Có' : 'Không' }}</td>
                                        <td>{{ $value->isNew == 1 ? 'Có' : 'Không' }}</td>
                                        <td>{{ $value->sale }}</td>
                                        <td>{{ number_format($value->gia - ($value->gia * $value->sale) / 100) }}</td>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="id_sanpham[]"
                                                    value="{{ $value->id }}">
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>
                                        <div>
                                            {{ $data->links() }}
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <a href="{{ route('thuoctinh.index') }}" class="btn btn-primary">Về lại danh sách </a>
                <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
            </form>
        </div>
    </div>
@endsection

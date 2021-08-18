@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-sm-12">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">THÊM MỚI THƯƠNG HIỆU</h6>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger small">
                        @foreach ($errors->all() as $value)
                            {{ $value }}<br>
                        @endforeach
                    </div>
                @endif
                @if (session('thongbao'))
                    <div class="alert alert-success small">
                        {{ session('thongbao') }}
                    </div>
                @endif
            </div>
            <div class="col-sm-6">

                <!-- Card Body -->
                <div class="card-body">

                    <form action="{{ route('thuonghieu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Nhập tên thương hiệu</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" name="ten"
                                aria-describedby="basic-addon3" value="{{ old('ten') }}">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Tải ảnh sản phẩm</span>
                                <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="fileImage"
                                    aria-describedby="basic-addon5" />
                            </div>
                        </div>

                        <a href="{{ route('thuonghieu.index') }}" class="btn btn-primary">
                            < Về lại danh sách</a>
                                <input type="submit" class="btn btn-success" value="Thêm mới">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Giới thiệu thương hiệu</label>
                    <textarea class="form-control rounded-0" name="gioithieu" id="gioithieu" cols="5" rows="5"></textarea>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@section('script')
    {{-- Thêm CKEditor vào --}}
    <script>
        CKEDITOR.replace('gioithieu', {
            filebrowserImageUploadUrl: "{{ route('ckeditor-upload', ['_token' => csrf_token()]) }}",
            filebrowserBrowseUrl: " {{ route('ckeditor-browser', ['_token' => csrf_token()]) }} ",
            filebrowserUploadMethod: "form",
        });
    </script>


@endsection

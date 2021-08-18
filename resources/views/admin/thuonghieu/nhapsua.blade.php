@extends('admin.layouts.index')

@section('noidung')
    @if (session('thongbao'))
        <div class="alert alert-success">
            {{ session('thongbao') }}
        </div>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <form action="{{ route('thuonghieu.update', $dataTH->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">THƯƠNG HIỆU MỚI THÊM</h6>

                    </div>
                    <!-- Card Body -->

                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Nhập tên thương hiệu</span>
                            </div>
                            <input type="text" class="form-control" value="{{ $dataTH->ten }}" id="basic-url" name="ten">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Tải ảnh sản phẩm</span>
                                <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="fileImage"
                                    aria-describedby="basic-addon5" />
                            </div>
                        </div>

                        <div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Giới thiệu sản phẩm</label>
                                <textarea class="form-control rounded-0" name="gioithieu" id="gioithieu" cols="100"
                                    rows="13">{{ $dataTH->gioithieu }}</textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('thuonghieu.index') }}" class="btn btn-primary">
                                < Về lại danh sách</a>
                                    <input type="submit" class="btn btn-success" value="Cập nhập">
                        </div>
    </form>

    </div>
    </div>
    </div>

    </div>

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

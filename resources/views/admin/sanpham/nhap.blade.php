@extends('admin.layouts.index')

@section('noidung')

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">THÊM MỚI SẢN PHẨM</h6>

        </div>

        @if (session('thongbao'))
            <div class="alert alert-success">
                {{ session('thongbao') }}
            </div>
        @endif

        <!-- Card Body -->
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger small">
                    @foreach ($errors->all() as $value)
                        {{ $value }}<br>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="input-group mb-3 col-sm-6">
                    <form action="{{ route('sanpham.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Nhập tên sản phẩm</span>
                            </div>
                            <input type="text" class="form-control" id="basic-url" name="ten" value="{{ old('ten') }}"
                                aria-describedby="basic-addon3">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Nhập đơn giá sản phẩm</span>
                            </div>
                            <input type="number" class="form-control text-right" name="gia" aria-describedby="basic-addon4"
                                value="{{ old('gia') }}">
                            <div class="input-group-prepend">
                                <span class="input-group-text">VNĐ</span>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon5">Tải ảnh sản phẩm</span>
                                <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="fileImage[]"
                                    multiple aria-describedby="basic-addon5" />
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="isHot" type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1"> HOT</label>

                                <input class="form-check-input ml-3" name="isNew" type="checkbox" id="inlineCheckbox2"
                                    value="1">
                                <label class="form-check-label" for="inlineCheckbox2"> NEW</label>
                            </div>

                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon6">Thương hiệu</span>
                            </div>
                            <div class="input-group-prepend">
                                <select class="form-select form-control" name="id_thuonghieu"
                                    aria-describedby="basic-addon6" aria-label="Default select example">
                                    @foreach ($thuonghieu as $value)
                                        <option value="{{ $value->id }}">{{ $value->ten }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon7">Chủng loại</span>
                            </div>
                            <div class="input-group-prepend">
                                <select class="form-select form-control" aria-describedby="basic-addon7" name="id_chungloai"
                                    aria-label="Default select example">
                                    @foreach ($chungloai as $value)
                                        <option value="{{ $value->id }}">{{ $value->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon12">Nhập sale</span>
                            </div>
                            <input type="number" class="form-control text-right col-sm-2" name="sale" value="0"
                                aria-describedby="basic-addon12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Nhập tags </span>
                            </div>
                            <input type="text" class="form-control" data-role="tagsinput" name="tag">
                        </div>

                </div>
                <div class="input-group mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Giới thiệu sản phẩm</label>
                        <textarea class="form-control rounded-0" name="gioithieu" id="gioithieu"></textarea>
                    </div>
                </div>
            </div>


            <a href="{{ route('sanpham.index') }}" class="btn btn-primary">
                < Về lại danh sách</a>
                    <input type="submit" class="btn btn-success ml-2" value="Thêm mới">
                    </form>



                @endsection

                @section('script')
                    {{-- Thêm CKEditor vào --}}
                    <script type="text/javascript">
                        CKEDITOR.replace('gioithieu', {
                            filebrowserImageUploadUrl: "{{ route('ckeditor-upload', ['_token' => csrf_token()]) }}",
                            filebrowserBrowseUrl: " {{ route('ckeditor-browser', ['_token' => csrf_token()]) }} ",
                            filebrowserUploadMethod: "form",
                        });
                    </script>

                @endsection

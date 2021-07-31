@extends('admin.layouts.index')

@section('noidung')

    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">CẬP NHẬP SẢN PHẨM</h6>

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
                    <form action="{{ route('sanpham.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')

                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Nhập tên sản phẩm</span>
                            </div>

                            <input type="text" class="form-control" id="basic-url" name="ten"
                                aria-describedby="basic-addon3" value="{{ $data->ten }}">

                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4">Nhập đơn giá sản phẩm</span>
                            </div>
                            <input type="number" class="form-control text-right" name="gia" value="{{ $data->gia }}"
                                aria-describedby="basic-addon4">
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
                                <input class="form-check-input" {{($data->isHot == 1) ? "checked" : ""}} name="isHot" type="checkbox" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1"> HOT</label>

                                <input class="form-check-input ml-3" {{($data->isNew == 1) ? "checked" : ""}} name="isNew" type="checkbox" id="inlineCheckbox2"
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
                                        <option @if ($value->id == $data->id_thuonghieu) selected @endif value="{{ $value->id }}">
                                            {{ $value->ten }} </option>
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
                                        <option @if ($value->id == $data->id_chungloai) selected @endif value="{{ $value->id }}">
                                            {{ $value->ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon12">Nhập sale</span>
                            </div>
                            <input type="number" class="form-control text-right col-sm-2" name="sale"
                                value="{{ $data->sale }}" aria-describedby="basic-addon12">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                </div>
                <div class="input-group mb-3 col-sm-6">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Giới thiệu sản phẩm</label>
                        <textarea class="form-control rounded-0" name="gioithieu" id="gioithieu" cols="100"
                            rows="13">{{ $data->gioithieu }}</textarea>
                    </div>
                </div>
            </div>

            <a href="{{ route('sanpham.index') }}" class="btn btn-primary">
                < Về lại danh sách</a>
                    <input type="submit" class="btn btn-success ml-2" value="Cập nhập">

        </div>
    </div>
    </form>

@endsection


@section('script')
    <script>
        tinymce.init({
            selector: '#gioithieu',
            width: '550px',
            height: '300px',
            plugins: 'image code',
            toolbar: 'undo redo | link image | code',
            /* enable title field in the Image dialog*/
            image_title: true,
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
              URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
              images_upload_url: 'postAcceptor.php',
              here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endsection

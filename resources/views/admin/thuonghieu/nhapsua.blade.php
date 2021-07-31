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
                                <input type="text" class="form-control" value="{{ $dataTH->ten }}" id="basic-url"
                                    name="ten">
                            </div>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon5">Tải ảnh sản phẩm</span>
                                  <input type="file" class="form-control-file ml-3 mt-1" id="customFile" name="fileImage" aria-describedby="basic-addon5" />
                              </div>
                          </div>

                            <div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Giới thiệu sản phẩm</label>
                                    <textarea class="form-control rounded-0" name="gioithieu" id="gioithieu"
                                        cols="100" rows="13">{{ $dataTH->gioithieu }}</textarea>
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


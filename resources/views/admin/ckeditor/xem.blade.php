<!doctype html>
<html lang="en">

<head>
    <title>Galary Image CKEditor</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{ asset('') }}">

    {{-- Thêm thư viện mirror chart js --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="admin/css/bootstrap-tagsinput.css">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    {{-- date picker --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- Bootstrap core JavaScript-->
    <script src="admin/vendor/jquery/jquery.min.js"></script>
    <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- Core plugin JavaScript-->
    <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="admin/js/sbadmin-2.min.js"></script>
    <script src="admin/js/bootstrap-tagsinput.min.js"></script>

    <!-- Page level plugins -->
    <script src="admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="admin/js/demo/chart-area-demo.js"></script>
    <script src="admin/js/demo/chart-pie-demo.js"></script>

    {{-- // datepicker --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    {{-- Editor text CKEditor --}}
    <script src="admin/ckeditor/ckeditor.js"></script>

    <?php $data1 = $_GET['CKEditorFuncNum']; ?>
    <script>
        $(function() {
            var funcNum = {{ $data1 }};

            $('#image_ckeditor_list').on('click', 'img', function() {
                var fileUrl = $(this).attr('title');
                window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl);
                window.close();
            }).hover(function() {
                $(this).css('cursor', 'poiter');
            });
        });
    </script>

</head>

<body>
    <div id="image_ckeditor_list">
        <div class="card">
            <img class="card-img-top" src="" alt="">
            <div class="card-body">
                <h5 class="card-title">Thư viện ảnh CKEditor</h5>
            </div>
            <div class="row">
                @foreach ($data as $value)
                    <div class="col-sm-3">
                        <img class="card-img-bottom" src="{{ $value->duongdan }}" alt=""
                            style="width: 250px; height: 250px;" title="{{ $value->duongdan }}">

                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>

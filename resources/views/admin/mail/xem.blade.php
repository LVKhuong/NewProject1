<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Send Mail</title>
    <base href="{{ asset('') }}">

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h1 class="m-0 font-weight-bold text-primary">Đơn hàng bạn đã đặt</h1>
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
                            <th>Tên sản phẩm</th>
                            <th>Gía</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php $stt = 0; ?>
                        @foreach ($details['dataInfo'] as $value)
                            <tr>
                                <td>{{ ++$stt }}</td>
                                <td>{{ $value->sanpham->ten }}</td>
                                <td>{{ number_format($value->gia) }}</td>
                                <td>{{ $value->soluong }}</td>
                                <td>{{ number_format($value->thanhtien) }}</td>
                        @endforeach
                        <td>{{ number_format($value->donhang->tongtien) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>

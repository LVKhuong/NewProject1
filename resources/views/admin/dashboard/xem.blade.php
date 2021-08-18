@extends('admin.layouts.index')

@section('noidung')
    <h4>DASHBOARD</h4>
    <br>
    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tổng thu nhập</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($tongThuNhap) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tổng số lượng bán được</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ route('chitietdonhang.index') }}">{{ $tongSoLuongBanRa }} Sản phẩm</a>
                            </div>
                        </div>
                        <div class="col-auto">

                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Đơn hàng thành công
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <a href="{{ route('donhang.index') }}">{{ $countDonHang }} Đơn hàng</a>
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"
                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Sản phẩm hết hàng</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <a href="{{ route('hethang') }}">{{ $countHetHang }} Sản phẩm</a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <h4><b>THỐNG KÊ LỢI NHUẬN, SỐ LƯỢNG, SỐ ĐƠN HÀNG THEO NGÀY</b></h4>
    <br>
    <form class="row">
        <div class="form-group col-sm-3">
            <div class="row">
                <label for="inputPassword" class="col-sm-4 col-form-label">Từ ngày</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="date_picker" name="tuNgay"
                        placeholder="Ví dụ : 14/03/1996">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-3">
            <div class="row">
                <label for="inputPassword" class="col-sm-4 col-form-label">Đến ngày</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="date_picker1" name="denNgay"
                        placeholder="Ví dụ : 21/01/1996">
                </div>
            </div>
        </div>
        <div class="form-group col-sm-4">
            <div class="row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Lọc theo</label>
                <div class="col-sm-9">
                    <select name="loc_SoNgay" id="loc_SoNgay" class="form-control">
                        <option checked>Vui lòng chọn</option>
                        <option value="week">7 ngày qua</option>
                        <option value="month">1 tháng qua</option>
                        <option value="year">1 năm qua</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <input type="button" id="btn_loc" value="Lọc" style="width:100%;" class="btn btn-primary">
        </div>
    </form>

    {{-- ajax -> view biểu đồ --}}
    <div class="row">
        <div class="col-sm-12">
            <div id="view_chart" style="height:300px;">

            </div>
        </div>
    </div>


@endsection


@section('script')
    <script>
        $(function() {
            // script chon ngay
            $("#date_picker").datepicker({
                dateFormat: 'yy-mm-dd',
            });
            $("#date_picker1").datepicker({
                dateFormat: 'yy-mm-dd',
            });

            // thêm thư viện mirror chart js
            var chart = new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'view_chart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                // data: [{
                //         ngay: '2008',
                //         tongtien: 20,
                //         soluong: 10,
                //         donhang: 2,
                //     },
                //     {
                //         ngay: '2009',
                //         tongtien: 20,
                //         soluong: 10,
                //         donhang: 2,
                //     },
                //     {
                //         ngay: '2010',
                //         tongtien: 20,
                //         soluong: 10,
                //         donhang: 2,
                //     },
                //     {
                //         ngay: '2011',
                //         tongtien: 20,
                //         soluong: 10,
                //         donhang: 2,
                //     },
                //     {
                //         ngay: '2012',
                //         tongtien: 20,
                //         soluong: 10,
                //         donhang: 2,
                //     }
                // ],
                hideHover: 'auto',
                // The name of the data record attribute that contains x-values.
                xkey: 'ngay',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['tongtien','soluong','donhang'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Tổng thu nhập : ', 'Tổng doanh số : ', 'Tổng đơn hàng : ']

            });

            // ajax lọc theo ngày
            $('#btn_loc').on('click', function() {
                var tuNgay = $('#date_picker').val();
                var denNgay = $('#date_picker1').val();

                $.ajax({
                    url: '{{ route('loc.ngay') }}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        tuNgay: tuNgay,
                        denNgay: denNgay,
                    }
                }).done(function(data) {
                    chart.setData(data);
                });

            });

            //ajax lọc của tag select
            $('#loc_SoNgay').change(function(){
                var tongngay = $('#loc_SoNgay').val();
                $.ajax({
                    url: '{{route('loc.select')}}',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {
                        tongngay: tongngay,
                    }
                }).done(function(data){
                    chart.setData(data);
                });
            });


        });
    </script>
@endsection

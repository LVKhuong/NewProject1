@extends('admin.layouts.index')

@section('noidung')
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="quanli/sanpham" class="m-0 font-weight-bold text-primary">Giảm giá</a>
        </div>
        <div class="card-body">
            <div class="card shadow mb-4">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên sản phẩm</th>
                                <th>Sale</th>
                                <th>Đơn giá</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('sanpham.sell') }}" method="POST">
                                @csrf

                                @foreach ($sanphams as $sanpham)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="id_sanpham[]"
                                                    id="inlineCheckbox1" value="{{ $sanpham->id }}">
                                                <label class="form-check-label"
                                                    for="inlineCheckbox1">{{ $sanpham->id }}</label>
                                            </div>
                                        </td>
                                        <td>{{ $sanpham->ten }}</td>
                                        <td>{{ $sanpham->sale }}</td>
                                        <td>{{ number_format($sanpham->gia) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        <input type="number" style="width: 50px" name="so_sale">
                                        <input type="submit" class="btn btn-primary" value="SALE">
                                    </td>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

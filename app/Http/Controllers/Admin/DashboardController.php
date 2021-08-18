<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ckeditor_image;
use App\Models\FileImage;
use App\Models\sanpham;
use App\Models\size_tongsoluong;
use App\Models\thongke;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // tính tổng tiền thu nhập 
        $tmp_tongtien = 0;

        // tính số lượng bán ra được all sản phẩm
        $tpm_tongsoluong = 0;

        // tính tổng đơn hàng
        $tmp_tongdonhang = 0;

        foreach (thongke::all() as $thongke) {
            $tmp_tongtien += $thongke->tong_tien;
            $tpm_tongsoluong += $thongke->tong_soluong;
            $tmp_tongdonhang += $thongke->tong_donhang;
        }

        // get all sản phẩm
        $count = 0;
        foreach (sanpham::all() as $value) {
            foreach ($value->size_tongsoluongs as $item) {
                if ($item->tongsoluong == 0) {
                    ++$count;
                }
            }
        }

        return view('admin.dashboard.xem', [
            'tongThuNhap' => $tmp_tongtien,
            'tongSoLuongBanRa' => $tpm_tongsoluong,
            'countDonHang' => $tmp_tongdonhang,
            'countHetHang' => $count,
        ]);
    }




    // view sản phẩm hết hàng
    public function sanphamHethang()
    {
        foreach (size_tongsoluong::all() as $value) {
            if ($value->tongsoluong == 0) {
                $data[] = $value;
            }
        }

        return view('admin.dashboard.xemsanphamhethang', [
            'data' => $data,
        ]);
    }




    // thống kê lọc theo ngày
    public function locTheoNgay(Request $request)
    {
        $data = $request->except('_token');

        $thongkes = thongke::whereBetween('ngaymua', [$data['tuNgay'], $data['denNgay']])->orderBy('ngaymua', 'asc')->get();

        foreach ($thongkes as $thongke) {
            $chart_data[] = array(
                'ngay' => $thongke->ngaymua,
                'tongtien' => $thongke->tong_tien,
                'donhang' => $thongke->tong_donhang,
                'soluong' => $thongke->tong_soluong,
            );
        }

        echo $data1 = json_encode($chart_data);
    }

    // Thống kê theo tuần, tháng, năm
    public function locSelect(Request $request)
    {
        // Thống kê 7 ngày qua
        if ($request->tongngay == 'week') {
            $week = Carbon::now()->subDay(7)->toDateString();
            $thongkes = thongke::whereBetween('ngaymua', [$week, Carbon::now()->toDateString()])->orderBy('ngaymua', 'asc')->get();

            foreach ($thongkes as $thongke) {
                $chart_data[] = array(
                    'ngay' => $thongke->ngaymua,
                    'tongtien' => $thongke->tong_tien,
                    'donhang' => $thongke->tong_donhang,
                    'soluong' => $thongke->tong_soluong,
                );
            }
        }

        // Thống kê 1 tháng qua
        if ($request->tongngay == 'month') {
            $month = Carbon::now()->subDay(30)->toDateString();
            $thongkes = thongke::whereBetween('ngaymua', [$month, Carbon::now()->toDateString()])->orderBy('ngaymua', 'asc')->get();

            foreach ($thongkes as $thongke) {
                $chart_data[] = array(
                    'ngay' => $thongke->ngaymua,
                    'tongtien' => $thongke->tong_tien,
                    'donhang' => $thongke->tong_donhang,
                    'soluong' => $thongke->tong_soluong,
                );
            }
        }

        // Thống kê 1 năm qua
        if ($request->tongngay == 'year') {
            $year = Carbon::now()->subDay(365)->toDateString();
            $thongkes = thongke::whereBetween('ngaymua', [$year, Carbon::now()->toDateString()])->orderBy('ngaymua', 'asc')->get();

            foreach ($thongkes as $thongke) {
                $chart_data[] = array(
                    'ngay' => $thongke->ngaymua,
                    'tongtien' => $thongke->tong_tien,
                    'donhang' => $thongke->tong_donhang,
                    'soluong' => $thongke->tong_soluong,
                );
            }
        }

        echo $data1 = json_encode($chart_data);
    }

    // upload ảnh cho ckeditor
    public function upload_ckeditor(Request $request)
    {
        if ($request->hasFile('upload')) {
            $tenFile = Str::random(6) . "_" . $request->file('upload')->getClientOriginalName();
            Storage::putFileAs('public/admin/images/ckeditor/', $request->file('upload'), $tenFile);

            $data = ckeditor_image::create([
                'ten_file' => $tenFile,
                'duongdan' => '/storage/admin/images/ckeditor/' . $tenFile,
            ]);
            
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('/storage/admin/images/ckeditor/'.$tenFile); 
            $msg = 'Bạn đã upload ảnh thành công'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    // view galary ảnh của ckeditor
    public function browser_ckeditor(){
        $data = ckeditor_image::all();

        return view('admin.ckeditor.xem', [
            'data' => $data,
        ]);
    }

}

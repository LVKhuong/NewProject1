<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\donhang;
use App\Mail\SendCartToMail;

class MailController extends Controller
{
    public function sendMail($iddonhang)
    {
        $details = [
            'data' => donhang::find($iddonhang),
            'dataInfo' => donhang::find($iddonhang)->chitietdonhang,
        ];

        Mail::to(donhang::find($iddonhang)->email)->send(new SendCartToMail($details));

        donhang::find($iddonhang)->update([
            'trangthai' => "Đã xác nhận",
        ]);

        return redirect()->route('donhang.index')->with('thongbao', 'Bạn đã gửi mail thành công');
    }
}

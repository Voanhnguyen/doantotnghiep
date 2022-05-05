<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class LoginController extends Controller
{
    //
    public function Index(){
        
        return view('a_client.login.index');

    }


    public function frmLogin(Request $request){
        $TaiKhoan = $request->get("TaiKhoan");
        $MatKhau = $request->get("MatKhau");
        
        $count = DB::table('nhanvien')
                        ->where('TaiKhoan', $TaiKhoan)
                        ->where('MatKhau', $MatKhau)
                        ->count();       
        if($count > 0){
            $nhanvien = DB::table('nhanvien')
                        ->where('TaiKhoan', $TaiKhoan)
                        ->where('MatKhau', $MatKhau)
                        ->first();
            $quyen = DB::table('quyen')
                        ->where('ID', $nhanvien->Quyen_ID)
                        ->first();
            if($nhanvien->Status == true){
                Session::put('nhanvien', $nhanvien);
                Session::put('quyen', $quyen->TenQuyen);
                return redirect('/thong-ke.html');
            }else{
                Session::flash('message', 'Đăng nhập không thành công. Tài khoản của bạn đã bị khóa.');
                return redirect('/dang-nhap.html');
            }    
        }else{
            Session::flash('message', 'Đăng nhập không thành công. Tài khoản hoặc mật khẩu không đúng.');
            return redirect('/dang-nhap.html');
        }
        
    }

    public function Logout(){
        Session::forget('nhanvien');
        Session::forget('quyen');
        return redirect('/dang-nhap.html');
    }
}

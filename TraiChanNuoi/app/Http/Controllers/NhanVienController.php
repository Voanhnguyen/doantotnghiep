<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class NhanVienController extends Controller
{
    //
    public function Index(){
        $query = DB::table('nhanvien')
                        ->join('quyen', 'quyen.ID', '=', 'nhanvien.Quyen_ID')
                        ->select('nhanvien.ID','quyen.GhiChu','nhanvien.HoTen','nhanvien.GioiTinh','nhanvien.SDT','nhanvien.DiaChi','nhanvien.Email','nhanvien.Status')
                        ->where('nhanvien.TaiKhoan', '!=', 'admin')
                        ->orderBy('ID', 'desc')
                        ->paginate(10);
        $quyen = DB::table('quyen')->get();
        
        return view('nhanvien.index')->with([
                                            'query'=> $query,
                                            'quyen'=> $quyen
                                        ]);
    }

    public function Delete($ID){
        DB::table('nhanvien')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function changeStatus($ID){
        $nhanvien = DB::table('nhanvien')->where("ID", $ID)->first();
        if($nhanvien->Status == 1)
            DB::update('update nhanvien set Status = ? where ID = ?', [0, $ID]);
        else
            DB::update('update nhanvien set Status = ? where ID = ?', [1, $ID]);

        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }


    public function frmAdd(Request $request){
        $TaiKhoan = $request->get("TaiKhoan");
        $MatKhau = $request->get("MatKhau");
        $HoTen = $request->get("HoTen");
        $GioiTinh = $request->get("GioiTinh");
        $Email = $request->get("Email");
        $SDT = $request->get("SDT");
        $DiaChi = $request->get("DiaChi");;
        $Status = true;
        $Quyen_ID = $request->get("Quyen_ID");
        $created_at = Carbon::now('Asia/Ho_Chi_Minh');
       
        
        DB::insert('insert into nhanvien 
            (TaiKhoan,  MatKhau, HoTen, GioiTinh, Email, SDT, DiaChi, Status, Quyen_ID, created_at) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
            [$TaiKhoan,  $MatKhau, $HoTen, $GioiTinh, $Email, $SDT, $DiaChi, $Status, $Quyen_ID, $created_at]);

        Session::flash('message', 'Thêm nhân viên thành công.');
        return redirect('/nhan-vien/danh-sach.html');
    }

   

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $HoTen = $request->get("HoTen");
        $GioiTinh = $request->get("GioiTinh");
        $Email = $request->get("Email");
        $SDT = $request->get("SDT");
        $DiaChi = $request->get("DiaChi");;
        $Quyen_ID = $request->get("Quyen_ID");
        $updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        DB::table('nhanvien')
            ->where("ID", $ID)
            ->update([
                'HoTen' => $HoTen,
                'GioiTinh' => $GioiTinh,
                'Email' => $Email,
                'SDT' => $SDT,
                'DiaChi' => $DiaChi,
                'Quyen_ID' => $Quyen_ID,
                'updated_at' => $updated_at
            ]);


        Session::flash('message', 'Cập nhật nhân viên thành công.');
        return redirect('/nhan-vien/danh-sach.html');
    }

    public function GetByID($ID){
        $query = DB::table('nhanvien')->where('ID', $ID)->first();

        return response()->json([
            'query' => $query
        ]);
    }

     public function ChangePass(){
        
        return view('nhanvien.changepass');
    }

    public function frmChangePass(Request $request){

        $ID = Session::get('nhanvien')->ID;
        $MatKhau = Session::get('nhanvien')->MatKhau;
        
        $Old_Pass = $request->get("Old_Pass");
        $New_Pass = $request->get("New_Pass");

        // echo "Old_Pass: " . $Old_Pass;
        // echo "MatKhau: " . $MatKhau;
        if($Old_Pass == $MatKhau){
            DB::update('update nhanvien set MatKhau = ? where ID = ?', [$New_Pass, $ID]);
            Session::forget('nhanvien');
            Session::flash('message', 'Đối mật khẩu thành công. Bạn vui lòng đăng nhập lại để tiếp tục.');
            return redirect('/dang-nhap.html');
        }else{
            Session::flash('message', 'Mật khẩu cũ không đúng, vui lòng nhập lại.');
            return redirect('/nhan-vien/doi-mat-khau.html');
        }
        
    }
}

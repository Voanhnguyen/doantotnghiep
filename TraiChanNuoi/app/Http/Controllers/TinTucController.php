<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use File;
class TinTucController extends Controller
{
    //
    public function Index(){
        $query = DB::table('tintuc')
                        ->join('loaitin', 'loaitin.ID', '=', 'tintuc.LoaiTin_ID')
                        ->select('tintuc.ID','tintuc.TieuDe','loaitin.Ten','tintuc.Anh','tintuc.NgayDang','tintuc.TrangThai')
                        // ->where('tintuc.TrangThai', 1)
                        ->orderBy('NgayDang', 'desc')
                        ->paginate(30);
        
        return view('tintuc.index')->with([
                                            'query'=> $query
                                        ]);
    }

    public function Delete($ID){
        $tintuc = DB::table('tintuc')->where('ID', $ID)->first();

        File::delete(public_path('/assets/img/news/' . $tintuc->Anh));

        DB::table('tintuc')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }

    public function changeStatus($ID){
        $status = "";
        $tintuc = DB::table('tintuc')->where('ID', $ID)->first();

        if($tintuc->TrangThai == 1){
            $status = 0;
        }else{
            $status = 1;
        }

        
        DB::table('tintuc')
            ->where("ID", $ID)
            ->update([
                'TrangThai' => $status
            ]);
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }


    public function Add(){
        $loaitin = DB::table('loaitin')->get();
        return view('tintuc.add')->with([
                                            'loaitin'=> $loaitin
                                        ]);
    }


    public function frmAdd(Request $request){
        $TieuDe = $request->get("TieuDe");
        $Metatitle = Str_Metatitle($request->get("TieuDe"));
        $NoiDung = $request->get("NoiDung");
        $NhanVien_ID = $request->get("NhanVien_ID");
        $LoaiTin_ID = $request->get("LoaiTin_ID");
        $TrangThai = true;
        $NgayDang = Carbon::now('Asia/Ho_Chi_Minh');

        $hinhanh = "";
        if ($request->hasFile('Anh')){
            $img_hinhanh = $request->file("Anh");
            // Thư mục upload
            $uploadPath = public_path('/assets/img/news/'). $img_hinhanh->getClientOriginalName(); // Thư mục upload

            if (File::exists($uploadPath)) {
                // Thư mục upload
                $uploadPath = public_path('/assets/img/news/'); // Thư mục upload
            
                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());
                $hinhanh = $img_hinhanh->getClientOriginalName();
            }else{
                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move(public_path('/assets/img/news/'), $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();
            }

        }
        
        DB::insert('insert into tintuc 
            (TieuDe,  Metatitle, NoiDung, NhanVien_ID, LoaiTin_ID, TrangThai, NgayDang, Anh) 
            values (?, ?, ?, ?, ?, ?, ?, ?)', 
            [$TieuDe,  $Metatitle, $NoiDung, $NhanVien_ID, $LoaiTin_ID, $TrangThai, $NgayDang, $hinhanh]);

        Session::flash('message', 'Thêm tin tức thành công.');
        return redirect('/tin-tuc/danh-sach.html');
    }

    public function Edit($ID){
        $loaitin = DB::table('loaitin')->get();
        $tintuc = DB::table('tintuc')->where("ID", $ID)->first();
        return view('tintuc.edit')->with([
                                            'tintuc'=> $tintuc,
                                            'loaitin'=> $loaitin
                                        ]);
    }

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $TieuDe = $request->get("TieuDe");
        $Metatitle = Str_Metatitle($request->get("TieuDe"));
        $NoiDung = $request->get("NoiDung");
        $LoaiTin_ID = $request->get("LoaiTin_ID");

        $tintuc = DB::table('tintuc')->where("ID", $ID)->first();
        
        if ($request->hasFile('Anh')){
                $img_hinhanh = $request->file("Anh");

                // Thư mục upload
                $uploadPath = public_path('/assets/img/news/'); // Thư mục upload
            
                // Bắt đầu chuyển file vào thư mục
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();

                $img = DB::table('tintuc')->where('ID', $ID)->first();
                if($img->Anh != $hinhanh){//Nếu có sửa file ảnh, thì tiến hành xóa ảnh cũ và thêm ảnh mới
                    File::delete(public_path('/assets/img/news/' . $img->Anh));
                    // $img_hinhanh->move($uploadPath, $hinhanh->getClientOriginalName());
                    DB::update('update tintuc set Anh = ? where ID = ?', [$hinhanh, $ID]);
                }
            }

        DB::table('tintuc')
            ->where("ID", $ID)
            ->update([
                'TieuDe' => $TieuDe,
                'Metatitle' => $Metatitle,
                'NoiDung' => $NoiDung,
                'LoaiTin_ID' => $LoaiTin_ID
            ]);


        Session::flash('message', 'Cập nhật tin tức thành công.');
        return redirect('/tin-tuc/danh-sach.html');
    }
}


function Str_Metatitle($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'a', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'e', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'i', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'o', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'u', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'y', $str);
        $str = preg_replace("/(Đ)/", 'd', $str);
        $str = preg_replace("/(' ')(/)(')(?)(!)(%)(#)(@)($)(%)(^)(&)(*)(=)(+)/", '-', $str);
        $str = str_replace(" ","-",trim($str));
        $str = strtolower($str);
        return $str;
    }
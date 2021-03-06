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
            // Th?? m???c upload
            $uploadPath = public_path('/assets/img/news/'). $img_hinhanh->getClientOriginalName(); // Th?? m???c upload

            if (File::exists($uploadPath)) {
                // Th?? m???c upload
                $uploadPath = public_path('/assets/img/news/'); // Th?? m???c upload
            
                // B???t ?????u chuy???n file v??o th?? m???c
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());
                $hinhanh = $img_hinhanh->getClientOriginalName();
            }else{
                // B???t ?????u chuy???n file v??o th?? m???c
                $img_hinhanh->move(public_path('/assets/img/news/'), $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();
            }

        }
        
        DB::insert('insert into tintuc 
            (TieuDe,  Metatitle, NoiDung, NhanVien_ID, LoaiTin_ID, TrangThai, NgayDang, Anh) 
            values (?, ?, ?, ?, ?, ?, ?, ?)', 
            [$TieuDe,  $Metatitle, $NoiDung, $NhanVien_ID, $LoaiTin_ID, $TrangThai, $NgayDang, $hinhanh]);

        Session::flash('message', 'Th??m tin t???c th??nh c??ng.');
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

                // Th?? m???c upload
                $uploadPath = public_path('/assets/img/news/'); // Th?? m???c upload
            
                // B???t ?????u chuy???n file v??o th?? m???c
                $img_hinhanh->move($uploadPath, $img_hinhanh->getClientOriginalName());

                $hinhanh = $img_hinhanh->getClientOriginalName();

                $img = DB::table('tintuc')->where('ID', $ID)->first();
                if($img->Anh != $hinhanh){//N???u c?? s???a file ???nh, th?? ti???n h??nh x??a ???nh c?? v?? th??m ???nh m???i
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


        Session::flash('message', 'C???p nh???t tin t???c th??nh c??ng.');
        return redirect('/tin-tuc/danh-sach.html');
    }
}


function Str_Metatitle($str) {
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
        $str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
        $str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
        $str = preg_replace("/(??)/", 'd', $str);

        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'a', $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", 'e', $str);
        $str = preg_replace("/(??|??|???|???|??)/", 'i', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", 'o', $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", 'u', $str);
        $str = preg_replace("/(???|??|???|???|???)/", 'y', $str);
        $str = preg_replace("/(??)/", 'd', $str);
        $str = preg_replace("/(' ')(/)(')(?)(!)(%)(#)(@)($)(%)(^)(&)(*)(=)(+)/", '-', $str);
        $str = str_replace(" ","-",trim($str));
        $str = strtolower($str);
        return $str;
    }
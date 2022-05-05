<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class LoaiTinController extends Controller
{
     public function Index(){
        $query = DB::table('loaitin')
                        ->orderBy('ID', 'desc')
                        ->paginate(10);
        
        return view('loaitin.index')->with([
                                            'query'=> $query
                                        ]);
    }

    public function Delete($ID){

        DB::table('loaitin')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }



    public function frmAdd(Request $request){
        $Ten = $request->get("Ten");
        $Link = Str_Metatitle($Ten);
       
        
        DB::insert('insert into loaitin 
            (Ten,  Link) 
            values (?, ?)', 
            [$Ten,  $Link]);

        Session::flash('message', 'Thêm danh mục tin tức thành công.');
        return redirect('/loai-tin/danh-sach.html');
    }

   

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $Ten = $request->get("Ten");
        $Link = Str_Metatitle($Ten);

        DB::table('loaitin')
            ->where("ID", $ID)
            ->update([
                'Ten' => $Ten,
                'Link' => $Link
            ]);


        Session::flash('message', 'Cập nhật danh mục tin tức thành công.');
        return redirect('/loai-tin/danh-sach.html');
    }

    public function GetByID($ID){
        $query = DB::table('loaitin')->where('ID', $ID)->first();

        return response()->json([
            'query' => $query
        ]);
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
        $str = preg_replace("/(' ')/", '-', $str);
        $str = str_replace(" ","-",trim($str));
        $str = strtolower($str);
        return $str;
    }
<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;

class TinTucController extends Controller
{
    //

    public function Detail($Metatitle, $ID){
        
        $tintuc = DB::table('tintuc')->where('ID', $ID)->first();

        //Tin cùng danh mục
        $same_tintuc = DB::table('tintuc')->where('LoaiTin_ID', $tintuc->LoaiTin_ID)->take(5)->get();

        $loaitin = DB::table('loaitin')->where('ID', $tintuc->LoaiTin_ID)->first();

        // Session::forget('Relate_news');
        //Lưu tin tức đã đọc
        if(Session::get('Relate_news') != null)
        {
            $arr = Session::get('Relate_news');

            if (!in_array($ID, $arr))
            {
                $arr[$ID] = [$tintuc];
                Session::put('Relate_news', $arr);
            }
        }
        else
        {
            $arr = array($ID => $tintuc);
            Session::put('Relate_news', $arr);
        }
        $Relate_news = Session::get('Relate_news');
        // print_r($sec);
        // foreach ($sec as $key => $value) {
        //     // code...
        //     foreach($value as $item){
        //         echo $item->TieuDe;
        //     }
            
        // }
        return view('a_client.tintuc.detail')->with([
                                            'tintuc'=> $tintuc,
                                            'same_tintuc'=> $same_tintuc,
                                            'Relate_news'=> $Relate_news,
                                            'loaitin'=> $loaitin
                                        ]);
    }

    public function Category($Link, $ID){
        
        $query = DB::table('tintuc')
                        ->join('loaitin', 'loaitin.ID', '=', 'tintuc.LoaiTin_ID')
                        ->where('tintuc.TrangThai', true)
                        ->where('tintuc.LoaiTin_ID', $ID)
                        ->select('tintuc.ID','tintuc.TieuDe', 'tintuc.Metatitle','loaitin.Ten','tintuc.Anh','tintuc.NgayDang','tintuc.TrangThai')
                        ->orderBy('tintuc.NgayDang')
                        ->paginate(12);

        $loaitin = DB::table('loaitin')->where('ID', $ID)->first();
        return view('a_client.tintuc.category')->with([
                                            'query'=> $query,
                                            'loaitin'=> $loaitin
                                        ]);

    }
          
}

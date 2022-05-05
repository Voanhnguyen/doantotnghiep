<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Arr;
class HomeController extends Controller
{
    //
     public function Index(){

        $order_ = array("date_esc","date_desc","name_esc","name_desc");

        $items = Arr::random($order_);

        if($items == "date_esc"){

            $query = DB::table('tintuc')
                        ->join('loaitin', 'loaitin.ID', '=', 'tintuc.LoaiTin_ID')
                        ->where('tintuc.TrangThai', true)
                        ->select('tintuc.ID','tintuc.TieuDe', 'tintuc.Metatitle','loaitin.Ten','tintuc.Anh','tintuc.NgayDang','tintuc.TrangThai')
                        ->orderBy('tintuc.NgayDang')
                        ->paginate(12);


        }else if($items == "date_desc"){

            $query = DB::table('tintuc')
                        ->join('loaitin', 'loaitin.ID', '=', 'tintuc.LoaiTin_ID')
                        ->where('tintuc.TrangThai', true)
                        ->select('tintuc.ID','tintuc.TieuDe', 'tintuc.Metatitle','loaitin.Ten','tintuc.Anh','tintuc.NgayDang','tintuc.TrangThai')
                        ->orderBy('NgayDang', 'desc')
                        ->paginate(12);


        }else if($items == "name_esc"){

            $query = DB::table('tintuc')
                        ->join('loaitin', 'loaitin.ID', '=', 'tintuc.LoaiTin_ID')
                        ->where('tintuc.TrangThai', true)
                        ->select('tintuc.ID','tintuc.TieuDe', 'tintuc.Metatitle','loaitin.Ten','tintuc.Anh','tintuc.NgayDang','tintuc.TrangThai')
                        ->orderBy('tintuc.TieuDe')
                        ->paginate(12);

            
        }else{

            $query = DB::table('tintuc')
                        ->join('loaitin', 'loaitin.ID', '=', 'tintuc.LoaiTin_ID')
                        ->where('tintuc.TrangThai', true)
                        ->select('tintuc.ID','tintuc.TieuDe', 'tintuc.Metatitle','loaitin.Ten','tintuc.Anh','tintuc.NgayDang','tintuc.TrangThai')
                        ->orderBy('tintuc.TieuDe', 'desc')
                        ->paginate(12);

            
        }
        
        return view('a_client.home.index')->with([
                                            'query'=> $query
                                        ]);
    }


    public function Contact(){
        
        return view('a_client.home.contact');

    }


    public function frmContact(Request $request){
        $HoTen = $request->get("HoTen");
        $TieuDe = $request->get("TieuDe");
        $NoiDung = $request->get("NoiDung");
        $Email = $request->get("Email");
        $SDT = $request->get("SDT");
        $NgayLH = Carbon::now('Asia/Ho_Chi_Minh');
       
        
        DB::insert('insert into lienhe 
            (HoTen,  TieuDe, NoiDung, Email, SDT, NgayLH) 
            values (?, ?, ?, ?, ?, ?)', 
            [$HoTen,  $TieuDe, $NoiDung, $Email, $SDT, $NgayLH]);

        Session::flash('message', 'Liên hệ website thành công. Cám ơn bạn đã liên hệ. Quản trị viên sẽ liên hệ bạn trong thời gian sớm nhất');
        return redirect('/lien-he.html');
    }
}

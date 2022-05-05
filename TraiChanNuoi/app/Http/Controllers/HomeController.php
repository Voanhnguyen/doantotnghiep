<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class HomeController extends Controller
{
    //
    public function Index(){
         //thống kê heo đã xuất
        $xuat = DB::table('xuat')
                        ->get();
        $Count_sl = 0;
        $Count_money = 0;
        $Count_cannang = 0;
        foreach ($xuat as $item) {
            # code...
            $Count_sl += $item->TongSL;
            $Count_money += $item->TongTien;
            $Count_cannang += $item->TongCanNang;
        }
        

         //Thống kê số chuồng
        $Count_chuong = DB::table('chuong')->count();

        //Thống kê giống
        $Count_giong = DB::table('giong')->count();

        //Thống kê tin tức
        $Count_tintuc = DB::table('tintuc')->count();

        //Thống kê liên hệ
        $Count_lienhe = DB::table('lienhe')->count();

        //Thống kê lượt chữa trị
        $Count_chuatri = DB::table('chuatri')->count();

        //Thống kê số nhân viên
        $Count_nv = DB::table('nhanvien')->count();

        //Thống kê nhập heo hôm nay
        $nhap_date = DB::table('nhap')->select('NgayNhap')->get();
        $nhap_today = 0;
        foreach ($nhap_date as $item) {
            # code...
            $date = Carbon::parse($item->NgayNhap)->format('d m Y');
            $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('d m Y');
            if($date == $datenow){
                $nhap_today++;
            }
        }

        //Thống kê xuất hôm nay
        $xuat_date = DB::table('xuat')->select('NgayXuat')->get();

        $xuat_today = 0;
        foreach ($xuat_date as $item) {
            # code...
            $date = Carbon::parse($item->NgayXuat)->format('d m Y');
            $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('d m Y');
            if($date == $datenow){
                $xuat_today++;
            }
        }

        return view('home.index')->with([
                'Count_sl'=> $Count_sl,
                'Count_money'=> $Count_money,
                'Count_cannang'=> $Count_cannang,
                'Count_chuong'=> $Count_chuong,
                'Count_giong'=> $Count_giong,
                'Count_tintuc' => $Count_tintuc,
                'Count_lienhe' => $Count_lienhe,
                'Count_chuatri' => $Count_chuatri,
                'Count_nv' => $Count_nv,
                'nhap_today' => $nhap_today,
                'xuat_today' => $xuat_today
            ]);
    }

    public function Charting(){
        $month = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $lstTotal = array();
        $model = DB::table('xuat')
                        ->select('TongTien','NgayXuat')
                        ->get();
        for($i = 1; $i <= 12; $i++)
        {
            $money = 0;
            foreach ($model as $item) {
                # code...
                $date = Carbon::parse($item->NgayXuat)->format('m');
                if($i == $date){
                    $money += $item->TongTien;
                }
            }
            $lstTotal[$i] = $money;
        }

        return response()->json([
            'lstTotal' => $lstTotal
        ]);
    }

    public function Error(){
        return view('home.error');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class ChuongController extends Controller
{
    //
    public function Index(){
        $query = DB::table('chuong')
                        ->orderBy('ID', 'desc')
                        ->paginate(10);
        
        return view('chuong.index')->with([
                                            'query'=> $query
                                        ]);
    }

    public function Delete($ID){

        DB::table('chuong')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }



    public function frmAdd(Request $request){
        $MaChuong = $request->get("MaChuong");
        
        DB::insert('insert into chuong 
            (MaChuong,  SoLuong) 
            values (?, ?)', 
            [$MaChuong,  0]);

        Session::flash('message', 'Thêm chuồng thành công.');
        return redirect('/chuong/danh-sach.html');
    }

   

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $MaChuong = $request->get("MaChuong");
        DB::table('chuong')
            ->where("ID", $ID)
            ->update([
                'MaChuong' => $MaChuong
            ]);


        Session::flash('message', 'Cập nhật chuồng thành công.');
        return redirect('/chuong/danh-sach.html');
    }

    public function GetByID($ID){
        $query = DB::table('chuong')->where('ID', $ID)->first();

        return response()->json([
            'query' => $query
        ]);
    }


    public function Info(){
        $chuong = DB::table('chuong')
                        ->get();

        
        $query = DB::table('ct_nhap')
                        ->join('nhap', 'nhap.ID', '=', 'ct_nhap.Nhap_ID')
                        ->where('ct_nhap.TinhTrang', true)
                        ->select('ct_nhap.Giong_ID','ct_nhap.SoLuong','ct_nhap.Chuong_ID')
                        ->get();
        $xuat = DB::table('ct_xuat')
                        ->join('xuat', 'xuat.ID', '=', 'ct_xuat.Xuat_ID')
                        ->where('ct_xuat.TinhTrang', true)
                        ->select('ct_xuat.Giong_ID','ct_xuat.SoLuong','ct_xuat.Chuong_ID')
                        ->get();
        $lstGiong = array();

        $dem = 0;
        foreach ($query as $item) {
            // code...
            $lstGiong[$dem]['Chuong_ID'] = $item->Chuong_ID;
            $lstGiong[$dem]['Giong_ID'] = $item->Giong_ID;
            $lstGiong[$dem]['Giong'] = DB::table('giong')->where('ID', $item->Giong_ID)->select('Ten')->first()->Ten;
            $exist_sl = $item->SoLuong;
            foreach ($xuat as $jtem) {
                // code...
                if($jtem->Giong_ID == $item->Giong_ID && $jtem->Chuong_ID == $item->Chuong_ID){
                    $exist_sl -= $jtem->SoLuong; 
                }
            }
            $lstGiong[$dem]['SoLuong'] = $exist_sl;
            $dem++;
            
        }

        // print_r($lstGiong);
        return view('chuong.info')->with([
                                            'chuong'=> $chuong,
                                            'lstGiong'=> $lstGiong
                                        ]);
    }

}

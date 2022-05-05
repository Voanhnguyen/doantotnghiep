<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class NhapController extends Controller
{
    //
    public function Index($nhap_id){
        $query = DB::table('nhap')
                        ->orderBy('NgayNhap', 'desc')
                        ->paginate(10);
        $ct_nhap = "";
        if($nhap_id != 0){
            $ct_nhap = DB::table('ct_nhap')
                        ->join('nhap', 'nhap.ID', '=', 'ct_nhap.Nhap_ID')
                        ->join('chuong', 'chuong.ID', '=', 'ct_nhap.Chuong_ID')
                        ->join('giong', 'giong.ID', '=', 'ct_nhap.Giong_ID')
                        ->where('ct_nhap.Nhap_ID', $nhap_id)
                        ->select('ct_nhap.ID','chuong.MaChuong','giong.Ten','ct_nhap.SoLuong','ct_nhap.DonGia','ct_nhap.Tong','ct_nhap.CanNang')
                        ->get();
            $nhap = DB::table('nhap')->where('ID', $nhap_id)->first();
        }else{
            $ID = DB::table('nhap')->max('ID');
            $ct_nhap = DB::table('ct_nhap')
                        ->join('nhap', 'nhap.ID', '=', 'ct_nhap.Nhap_ID')
                        ->join('chuong', 'chuong.ID', '=', 'ct_nhap.Chuong_ID')
                        ->join('giong', 'giong.ID', '=', 'ct_nhap.Giong_ID')
                        ->where('ct_nhap.Nhap_ID', $ID)
                        ->select('ct_nhap.ID','chuong.MaChuong','giong.Ten','ct_nhap.SoLuong','ct_nhap.DonGia','ct_nhap.Tong','ct_nhap.CanNang')
                        ->get();
            $nhap = DB::table('nhap')->where('ID', $ID)->first();
        }             

        
        return view('nhap.index')->with([
                                            'query'=> $query,
                                            'nhap'=> $nhap,
                                            'ct_nhap'=> $ct_nhap
                                        ]);
    }


    public function Add(){
        $chuong = DB::table('chuong')->where('SoLuong', 0)->get();
        $giong = DB::table('giong')->get();
        return view('nhap.add')->with([
                                            'giong'=> $giong,
                                            'chuong'=> $chuong
                                        ]);
    }


    public function frmAdd(Request $request){

        $TongTien = $request->get("TongTien");
        $TongSL = $request->get("TongSL");
        $TongCanNang = $request->get("TongCanNang");
        $NgayNhap = Carbon::now('Asia/Ho_Chi_Minh');

        DB::insert('insert into nhap 
            (TongTien, TongSL, TongCanNang, NgayNhap, TinhTrang) 
            values (?, ?, ?, ?, ?)', 
            [$TongTien, $TongSL, $TongCanNang, $NgayNhap, true]);

        $inward = session()->get('inward');
        
        $nhap_id = DB::table('nhap')->max('ID');

        foreach ($inward as $key => $value) {

            $SoLuong = $value['SoLuong'];
            $Tong = $value['TongTien'];
            $Chuong_ID = $key;
            $Giong_ID = $value['Giong_ID'];
            $CanNang = $value['CanNang'];
            $DonGia = $Tong / $SoLuong;

           DB::insert('insert into ct_nhap 
            (Giong_ID,  Chuong_ID, Nhap_ID, SoLuong, DonGia, Tong, CanNang) 
            values (?, ?, ?, ?, ?, ?, ?)', 
            [$Giong_ID,  $Chuong_ID, $nhap_id, $SoLuong, $DonGia, $Tong, $CanNang]);

           //Cập nhật số lượng heo trong chuông

            $chuong = DB::table('chuong')->where('ID', $Chuong_ID)->first();

            $soluong = $chuong->SoLuong + $SoLuong;
            DB::table('chuong')
            ->where("ID", $Chuong_ID)
            ->update([
                'SoLuong' => $soluong,
                'NgayNhap' => $NgayNhap
            ]);

            //Cập nhật trạng thái xuát
            DB::table('ct_xuat')
                ->where("Chuong_ID", $Chuong_ID)
                ->update([
                    'TinhTrang' => false
                ]);

        }
        Session::forget('inward');

        Session::flash('message', 'Nhập heo thành công.');

        return redirect('/nhap/danh-sach/0');
    }

   
    public function AddNhap(Request $request){
        $SoLuong  = $request->get("SoLuong");
        $Chuong_ID  = $request->get("Chuong_ID");
        $Giong_ID  = $request->get("Giong_ID");
        $CanNang  = $request->get("CanNang");
        $TongTien  = $request->get("TongTien");


        $chuong = DB::table('chuong')->where('ID', $Chuong_ID)->first();
        $giong = DB::table('giong')->where('ID', $Giong_ID)->first();


        if(Session::get('inward') == null){

            $inward = [
                $Chuong_ID =>[
                    "SoLuong" => $SoLuong,
                    "MaChuong" => $chuong->MaChuong,
                    "Chuong_ID" => $Chuong_ID,
                    "TenGiong" => $giong->Ten,
                    "DonGia" => $giong->Gia,
                    "Giong_ID" => $Giong_ID,
                    "CanNang" => $CanNang,
                    "TongTien" => $TongTien
                ]
            ];
            Session::put('inward', $inward);

        }else{
            $inward = Session::get('inward');
            // $check = false;

            if(isset($inward[$Chuong_ID]) && $inward[$Chuong_ID]['Chuong_ID'] == $Chuong_ID && $inward[$Chuong_ID]['Giong_ID'] == $Giong_ID){

                $inward[$Chuong_ID]['SoLuong'] += $SoLuong;
                $inward[$Chuong_ID]['CanNang'] += $CanNang;
                $inward[$Chuong_ID]['TongTien'] = $inward[$Chuong_ID]['SoLuong'] * $inward[$Chuong_ID]['DonGia'];

                Session::put('inward', $inward);
                // $check = true;

            }else{
                $inward[$Chuong_ID] =  [
                   "SoLuong" => $SoLuong,
                   "MaChuong" => $chuong->MaChuong,
                   "Chuong_ID" => $Chuong_ID,
                   "TenGiong" => $giong->Ten,
                   "DonGia" => $giong->Gia,
                   "Giong_ID" => $Giong_ID,
                   "CanNang" => $CanNang,
                   "TongTien" => $TongTien
                ];
                Session::put('inward', $inward);
            }
            
        }

        return response()->json([
              'success' => 'Record deleted successfully!'
        ]);



    }

    public function Delete($ID){
        $inward = Session::get('inward');
        foreach ($inward as $key=>$value) {
            # code...
            if($key == $ID){
                unset($inward[$key]);
            }
        }
        Session::put('inward', $inward);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function Edit($ID, $SoLuong){
        $inward = Session::get('inward');
        
        foreach ($inward as $key=>$value) {
            # code...
            if($key == $ID){
                $Giong_ID = $inward[$key]['Giong_ID'];
                $gia = $inward[$key]['DonGia'];
                $inward[$key]['SoLuong'] = $SoLuong;
                $inward[$key]['TongTien'] = $inward[$key]['SoLuong'] * $gia;
            }
        }
        Session::put('inward', $inward);
        return response()->json([
                'success' => 'Record deleted successfully!'
        ]);
    }
   
}

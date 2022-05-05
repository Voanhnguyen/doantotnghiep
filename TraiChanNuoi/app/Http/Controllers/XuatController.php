<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class XuatController extends Controller
{
    //
    public function Index(){
        $query = DB::table('xuat')
                        ->orderBy('NgayXuat', 'desc')
                        ->paginate(10);
        
        return view('xuat.index')->with([
                                            'query'=> $query
                                        ]);
    }


    public function Add(){
        $chuong = DB::table('chuong')->where('SoLuong', '>', 0)->get();
        $giong = DB::table('giong')->get();
        return view('xuat.add')->with([
                                            'chuong'=> $chuong
                                        ]);
    }


    public function frmAdd(Request $request){

        $TenNguoiMua = $request->get("TenNguoiMua");
        $SDT = $request->get("SDT");
        $LoaiNguoiMua = $request->get("LoaiNguoiMua");
        $TongTien = $request->get("TongTien");
        $TongSL = $request->get("TongSL");
        $TongCanNang = $request->get("TongCanNang");
        $NgayXuat = Carbon::now('Asia/Ho_Chi_Minh');

        DB::insert('insert into xuat 
            (TenNguoiMua, SDT, LoaiNguoiMua, NgayXuat, TongSL, TongTien, TongCanNang, TinhTrang) 
            values (?, ?, ?, ?, ?, ?, ?, ?)', 
            [$TenNguoiMua, $SDT, $LoaiNguoiMua, $NgayXuat, $TongSL, $TongTien, $TongCanNang, true]);

        $xuat_section = session()->get('xuat_section');
        
        $xuat_id = DB::table('xuat')->max('ID');

        foreach ($xuat_section as $key => $value) {

            $SoLuong = $value['SoLuong'];
            $TongTien = $value['TongTien'];
            $Chuong_ID = $key;
            $TongCanNang = $value['TongCanNang'];
            $Giong_ID = $value['Giong_ID'];
            $DonGia = $TongTien / ($SoLuong * $TongCanNang);

           DB::insert('insert into ct_xuat 
            (Chuong_ID, Xuat_ID, SoLuong, DonGia, TongTien, TongCanNang, Giong_ID) 
            values (?, ?, ?, ?, ?, ?, ?)', 
            [$Chuong_ID, $xuat_id, $SoLuong, $DonGia, $TongTien, $TongCanNang, $Giong_ID]);

           //Cập nhật số lượng heo trong chuông

            $chuong = DB::table('chuong')->where('ID', $Chuong_ID)->first();

            $soluong = $chuong->SoLuong - $SoLuong;

            if($SoLuong == 0){
                $NgayNhap = null;
                DB::table('chuong')
                ->where("ID", $Chuong_ID)
                ->update([
                    'SoLuong' => $soluong,
                    'NgayNhap' => $NgayNhap
                ]);

                //Cập nhật trạng thái nhập
                DB::table('ct_nhap')
                ->where("Chuong_ID", $Chuong_ID)
                ->update([
                    'TinhTrang' => false
                ]);
            }else{
                DB::table('chuong')
                ->where("ID", $Chuong_ID)
                ->update([
                    'SoLuong' => $soluong
                ]);
            }
            

        }
        Session::forget('xuat_section');

        Session::flash('message', 'Xuất heo thành công.');

        return redirect('/xuat/danh-sach.html');
    }

   
    public function AddNhap(Request $request){
        $SoLuong  = $request->get("SoLuong");
        $Chuong_ID  = $request->get("Chuong_ID");
        $DonGia  = $request->get("DonGia");
        $TongCanNang  = $request->get("TongCanNang");
        $TongTien  = $request->get("TongTien");
        $Giong_ID  = $request->get("Giong_ID");

        $chuong = DB::table('chuong')->where('ID', $Chuong_ID)->first();
        $giong = DB::table('giong')->where('ID', $Giong_ID)->first();

        if(Session::get('xuat_section') == null){

            $xuat_section = [
                $Chuong_ID =>[
                    "SoLuong" => $SoLuong,
                    "MaChuong" => $chuong->MaChuong,
                    "Chuong_ID" => $Chuong_ID,
                    "Giong_ID" => $Giong_ID,
                    "TenGiong" => $giong->Ten,
                    "DonGia" => $DonGia,
                    "TongCanNang" => $TongCanNang,
                    "TongTien" => $TongTien
                ]
            ];
            Session::put('xuat_section', $xuat_section);

        }else{
            $xuat_section = Session::get('xuat_section');
            
            if(isset($xuat_section[$Chuong_ID]) && $xuat_section[$Chuong_ID]['Chuong_ID'] == $Chuong_ID && $xuat_section[$Chuong_ID]['Giong_ID'] == $Giong_ID){
                $xuat_section[$Chuong_ID]['SoLuong'] += $SoLuong;
                $xuat_section[$Chuong_ID]['TongCanNang'] += $TongCanNang;
                $xuat_section[$Chuong_ID]['TongTien'] = $xuat_section[$Chuong_ID]['DonGia'] * $xuat_section[$Chuong_ID]['SoLuong'] * $xuat_section[$Chuong_ID]['TongCanNang'];
                Session::put('xuat_section', $xuat_section);
            }else{
                $xuat_section[$Chuong_ID] =  [
                   "SoLuong" => $SoLuong,
                   "MaChuong" => $chuong->MaChuong,
                   "Chuong_ID" => $Chuong_ID,
                   "Giong_ID" => $Giong_ID,
                   "TenGiong" => $giong->Ten,
                   "DonGia" => $DonGia,
                   "TongCanNang" => $TongCanNang,
                   "TongTien" => $TongTien
                ];
                Session::put('xuat_section', $xuat_section);
            }
            
        }
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);

    }

    public function Delete($ID){
        $xuat_section = Session::get('xuat_section');
        foreach ($xuat_section as $key=>$value) {
            # code...
            if($key == $ID){
                unset($xuat_section[$key]);
            }
        }
        Session::put('xuat_section', $xuat_section);
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function Edit($ID, $SoLuong){
        $xuat_section = Session::get('xuat_section');
        foreach ($xuat_section as $key=>$value) {
            # code...
            if($key == $ID){
                $xuat_section[$key]['SoLuong'] = $SoLuong;
                $xuat_section[$key]['TongTien'] = $xuat_section[$key]['DonGia'] * $xuat_section[$key]['SoLuong'] * $xuat_section[$key]['TongCanNang'];
            }
        }
        Session::put('xuat_section', $xuat_section);
        return response()->json([
                'success' => 'Record deleted successfully!'
        ]);
    }

    public function GetGiongByChuongNhap($Chuong_ID){
        $query = DB::table('ct_nhap')
                        ->join('nhap', 'nhap.ID', '=', 'ct_nhap.Nhap_ID')
                        ->where('ct_nhap.TinhTrang', true)
                        ->where('ct_nhap.Chuong_ID', $Chuong_ID)
                        ->select('ct_nhap.Giong_ID','ct_nhap.SoLuong')
                        ->get();
        $xuat = DB::table('ct_xuat')
                        ->join('xuat', 'xuat.ID', '=', 'ct_xuat.Xuat_ID')
                        ->where('ct_xuat.TinhTrang', true)
                        ->where('ct_xuat.Chuong_ID', $Chuong_ID)
                        ->select('ct_xuat.Giong_ID','ct_xuat.SoLuong')
                        ->get();
        $lstGiong = array();

        $dem = 0;
        foreach ($query as $item) {
            // code...
            $lstGiong[$dem]['Giong_ID'] = $item->Giong_ID;
            $lstGiong[$dem]['Giong'] = DB::table('giong')->where('ID', $item->Giong_ID)->select('Ten')->first();
            $exist_sl = $item->SoLuong;
            foreach ($xuat as $jtem) {
                // code...
                if($jtem->Giong_ID == $item->Giong_ID){
                    $exist_sl -= $jtem->SoLuong; 
                }
            }
            $lstGiong[$dem]['SoLuong'] = $exist_sl;
            $dem++;
            
        }

        return response()->json([
                'query' => $query,
                'xuat' => $xuat,
                'lstGiong' => $lstGiong
        ]);
    }

    public function Detail($ID){
        $query = DB::table('ct_xuat')
                        ->join('xuat', 'xuat.ID', '=', 'ct_xuat.Xuat_ID')
                        ->join('chuong', 'chuong.ID', '=', 'ct_xuat.Chuong_ID')
                        ->join('giong', 'giong.ID', '=', 'ct_xuat.Giong_ID')
                        ->where('ct_xuat.Xuat_ID', $ID)
                        ->select('ct_xuat.ID','chuong.MaChuong','giong.Ten','ct_xuat.SoLuong','giong.Ten','ct_xuat.DonGia','ct_xuat.TongTien','ct_xuat.TongCanNang')
                        ->get();
        $xuat =  DB::table('xuat')->where('ID', $ID)->first();
        return view('xuat.detail')->with([
                                            'query'=> $query,
                                            'xuat'=> $xuat
                                        ]);
    }
}

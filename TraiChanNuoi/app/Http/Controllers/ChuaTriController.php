<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class ChuaTriController extends Controller
{
    //
    public function Index(){
        $query = DB::table('chuatri')
                        ->join('chuong', 'chuong.ID', '=', 'chuatri.Chuong_ID')
                        ->select('chuatri.ID','chuatri.NgayChuaTri','chuatri.LoaiBenh','chuatri.LoaiThuoc','chuatri.SoLuong','chuatri.GhiChu','chuong.MaChuong')
                        ->orderBy('NgayChuaTri', 'desc')
                        ->paginate(10);
        $chuong = DB::table('chuong')->get();
        return view('chuatri.index')->with([
                                            'query'=> $query,
                                            'chuong'=> $chuong
                                        ]);
    }

    public function Delete($ID){

        DB::table('chuatri')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }



    public function frmAdd(Request $request){
        $NgayChuaTri = Carbon::createFromFormat('d/m/Y', $request->get("NgayChuaTri"))->format('Y-m-d'); ;
        $LoaiBenh = $request->get("LoaiBenh");
        $LoaiThuoc = $request->get("LoaiThuoc");
        $SoLuong = $request->get("SoLuong");
        $GhiChu = $request->get("GhiChu");
        $Chuong_ID  = $request->get("Chuong_ID");
        
        DB::insert('insert into chuatri 
            (NgayChuaTri,  LoaiBenh, LoaiThuoc, SoLuong, GhiChu, Chuong_ID) 
            values (?, ?, ?, ?, ?, ?)', 
            [$NgayChuaTri,  $LoaiBenh, $LoaiThuoc, $SoLuong, $GhiChu, $Chuong_ID]);

        Session::flash('message', 'Thêm chữa trị thành công.');
        return redirect('/chuatri/danh-sach.html');
    }

   

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $NgayChuaTri = Carbon::createFromFormat('d/m/Y', $request->get("NgayChuaTri"))->format('Y-m-d'); ;
        $LoaiBenh = $request->get("LoaiBenh");
        $LoaiThuoc = $request->get("LoaiThuoc");
        $SoLuong = $request->get("SoLuong");
        $GhiChu = $request->get("GhiChu");
        $Chuong_ID  = $request->get("Chuong_ID");
        DB::table('chuatri')
            ->where("ID", $ID)
            ->update([
                'NgayChuaTri' => $NgayChuaTri,
                'LoaiBenh' => $LoaiBenh,
                'LoaiThuoc' => $LoaiThuoc,
                'SoLuong' => $SoLuong,
                'GhiChu' => $GhiChu,
                'Chuong_ID' => $Chuong_ID
            ]);


        Session::flash('message', 'Cập nhật chữa trị thành công.');
        return redirect('/chuatri/danh-sach.html');
    }

    public function GetByID($ID){
        $chuatri = DB::table('chuatri')->where('ID', $ID)->first();

        $query = new \stdClass;
        $query->ID = $chuatri->ID;
        $query->LoaiBenh = $chuatri->LoaiBenh;
        $query->LoaiThuoc = $chuatri->LoaiThuoc;
        $query->SoLuong = $chuatri->SoLuong;
        $query->NgayChuaTri = Carbon::parse($chuatri->NgayChuaTri)->format('d/m/Y');
        $query->GhiChu = $chuatri->GhiChu;
        $query->Chuong_ID = $chuatri->Chuong_ID;
        return response()->json([
            'query' => $query
        ]);
    }
}

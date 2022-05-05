<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class GiongController extends Controller
{
    //
    public function Index(){
        $query = DB::table('giong')
                        ->orderBy('ID', 'desc')
                        ->paginate(10);
        
        return view('giong.index')->with([
                                            'query'=> $query
                                        ]);
    }

    public function Delete($ID){

        DB::table('giong')
            ->where("ID", $ID)
            ->delete();
        return response()->json([
         'success' => 'Record deleted successfully!'
     ]);
    }



    public function frmAdd(Request $request){
        $Ten = $request->get("Ten");
        $Gia = $request->get("Gia");
        
        DB::insert('insert into giong 
            (Ten,  Gia) 
            values (?, ?)', 
            [$Ten,  $Gia]);

        Session::flash('message', 'Thêm giống thành công.');
        return redirect('/giong/danh-sach.html');
    }

   

    public function frmEdit(Request $request){

        $ID = $request->get("ID");
        $Ten = $request->get("Ten");
        $Gia = $request->get("Gia");
        DB::table('giong')
            ->where("ID", $ID)
            ->update([
                'Ten' => $Ten,
                'Gia' => $Gia
            ]);


        Session::flash('message', 'Cập nhật giống thành công.');
        return redirect('/giong/danh-sach.html');
    }

    public function GetByID($ID){
        $query = DB::table('giong')->where('ID', $ID)->first();

        return response()->json([
            'query' => $query
        ]);
    }
}

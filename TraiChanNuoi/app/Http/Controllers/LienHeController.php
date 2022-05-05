<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
class LienHeController extends Controller
{
    //

    public function Index(){
        $query = DB::table('lienhe')
                        ->orderBy('NgayLH', 'desc')
                        ->paginate(10);
        
        return view('lienhe.index')->with([
                                            'query'=> $query
                                        ]);
    }

     public function GetByID($ID){
        $lienhe = DB::table('lienhe')->where('ID', $ID)->first();

        $query = new \stdClass;
        $query->Email = $lienhe->Email;
        $query->HoTen = $lienhe->HoTen;
        $query->TieuDe = $lienhe->TieuDe;
        $query->NgayLH = Carbon::parse($lienhe->NgayLH)->format('d-m-Y'); 
        $query->SDT = $lienhe->SDT;
        $query->NoiDung = $lienhe->NoiDung;
        return response()->json([
            'query' => $query
        ]);
    }
}

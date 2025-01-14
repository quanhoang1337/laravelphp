<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TinTucController extends Controller
{
    function tinXN(){
        $kq = DB::table('tin')
        ->select('id', 'tieuDe', 'xem')
        ->orderBy('xem', 'desc')->limit(10)
        ->get();
        return view('txn', ['data' => $kq]);
    }
}

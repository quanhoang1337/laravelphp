<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThuctapController extends Controller
{
    //
    public function cong2so($a, $b) {
        $kq = $a+ $b;
        return view('cong2so', ['kq' => $kq]);
    }
}

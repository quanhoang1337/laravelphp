<?php

use App\Http\Controllers\ChaoController;
use App\Http\Controllers\TinTucController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('xinchao', function() {
    return view('xinchao');
});

Route::get('xinchao1', [ChaoController::class, 'xin_chao']);

Route::get(uri: '/db1', action: function():void {
    $squery = DB::table(table: 'loaitin')
    ->select('id', 'ten');
    $kq = $squery->first();
    echo $kq->ten;
});

Route::get(uri: '/db2', action: function():void {
    $squery = DB::table(table: 'loaitin')
    ->select('id', 'ten');

    $kq = $squery->get();
    foreach ($kq as $row) {
        echo "<p> {$row->ten} </p>";
    }
});

Route::get(uri: '/db3', action: function():void {
    $t = DB::table('loaitin')->where('id', '=',3)->value('ten');
    echo $t;
});

Route::get(uri: '/db4', action: function():void {
    $arr= DB::table('loaitin')->pluck('ten');
    foreach( $arr as $ten) echo "<p> {$ten} </p>";
});

Route::get(uri: '/db5', action: function():void {
    $sotin = DB::table('tin')->WHERE('noibat',1)
    ->count();
    echo "so tin noi bat: $sotin <br/>";

    $mn = DB::table('tin')->max("ngayDang");
    echo "Tin moi nhat dang ngay: $mn <br/>";

    $sn = DB::table('tin')->min("ngayDang");
    echo "Tin moi nhat dang ngay: $sn <br/>";

    $tb = DB::table('tin')->avg("xem");
    echo "xem trung binh $tb <br/>";

    $tong = DB::table('tin')->sum("xem");
    echo "tong xem  $tong <br/>";
});

Route::get(uri: '/db6', action: function():void {
    $kq = DB::table('loaitin')
    ->where('id', 1111)->exists();
    if (!$kq) echo"khong ton tai loai tin nay";
});

Route::get(uri: '/db7', action: function():void {
    $squery = DB::table('loaitin')
    ->where('anhien','=',1)
    ->orderBy('ten','ASC')
    ->offset(5)
    ->limit(10);
    $kq = $squery->get();
    foreach ($kq as $row) {
        echo "<p>{$row->ten} </p>";
    }
});

Route::get(uri: '/db8', action: function():void {
    $squery = DB::table('tin')
    ->join('loaitin', 'tin.idLT', '=', 'loaitin.id')
    ->select('tin.id', 'tin.tieuDe', 'loaitin.ten');
    $kq = $squery->get();
    foreach ($kq as $row) {
        echo "<p>{$row->tieuDe} ({$row->ten}) <p/>";
    }
});

Route::get(uri: '/db9', action: function():void {
    DB::table('tin')
    ->insert(['tieuDe'=>'Viet nam vo dich', 'idLT'=>1 ]);
});

Route::get(uri: '/db10', action: function():void {
    $id = DB::table('tin')
    ->insertGetId(['tieuDe'=> 'VN vo dich AFF']);
    echo "id cua record moi chen: $id";
});

Route::get(uri: '/db11', action: function():void {
    DB::table('tin')->insert( [
        [ 'tieuDe'=>'VN men yeu', 'idLT'=>1 ],
        [ 'tieuDe'=>'VN yeu men', 'idLT'=>1 ],
    ]);
});

Route::get(uri: '/db12', action: function():void {
    DB::table('tin')->where('id','=',800)
    ->update( ['tieuDe'=>'Viet Nam Tuyet Voi', 'idLT'=>3] );
});

Route::get(uri: '/db13', action: function():void {
    DB::table('tin')->where('id','=', 802)->delete();
});


Route::get('/txn/', [TinTucController::class, 'tinXN']);
 

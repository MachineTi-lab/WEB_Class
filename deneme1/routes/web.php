<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::post('/giris', function (Request $request) {
    $kullanici = $request->input('kullanici');
    $sifre = $request->input('sifre');

    if ($kullanici === 'halil' && $sifre === '1234') {
        # Deneme amaçlı kısım
        $mesaj = "Giriş başarılı! Hoş geldin, $kullanici 👋";
    } else {
        $mesaj = "Kullanıcı adı veya şifre hatalı!";
    }

    return view('home', compact('mesaj'));#Her istekte her türlü render atıyor
});

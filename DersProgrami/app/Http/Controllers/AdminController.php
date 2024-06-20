<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kullanici;
use App\Models\Bolum;
use App\Models\Unvan;
use App\Models\Yetki;

class AdminController extends Controller
{
    public function kullaniciListesi()
    {
        $kullanicilar = Kullanici::all();
        return view('admin.kullanicilar', compact('kullanicilar'));
    }

    public function kullaniciEkle(Request $request)
    {
        $kullanici = Kullanici::create($request->all());
        return response()->json($kullanici);
    }

    public function kullaniciGetir($id)
    {
        $kullanici = Kullanici::findOrFail($id);
        return response()->json($kullanici);
    }

    public function kullaniciGuncelle(Request $request, $id)
    {
        $kullanici = Kullanici::findOrFail($id);
        $kullanici->update($request->all());
        return response()->json($kullanici);
    }

    public function kullaniciDuzenleForm($id)
    {
        $kullanici = Kullanici::findOrFail($id);
        return response()->json($kullanici);
    }

    public function kullaniciSil($id)
    {
        $kullanici = Kullanici::findOrFail($id);
        $kullanici->delete();
        return response()->json(['success' => true]);
    }

    public function bolumler()
    {
        $bolumler = Bolum::all();
        return response()->json($bolumler);
    }

    public function unvanlar()
    {
        $unvanlar = Unvan::all();
        return response()->json($unvanlar);
    }

    public function yetkiler()
    {
        $yetkiler = Yetki::all();
        return response()->json($yetkiler);
    }
}

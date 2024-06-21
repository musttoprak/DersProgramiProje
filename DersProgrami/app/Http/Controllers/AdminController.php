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
        // Form verilerini ayrı değişkenlere atayarak güncelleme yapma
        $mail = $request['mailEdit'];
        $sifre = $request['sifreEdit'];
        $ad = $request['adEdit'];
        $soyad = $request['soyadEdit'];
        $bolumId = $request['bolumIdEdit'];
        $unvanId = $request['unvanIdEdit'];
        $yetkiId = $request['yetkiIdEdit'];

        // Veritabanında güncelleme işlemi
        $kullanici = Kullanici::findOrFail($id);
        $kullanici->mail = $mail;
        $kullanici->sifre = $sifre;
        $kullanici->ad = $ad;
        $kullanici->soyad = $soyad;
        $kullanici->bolumId = $bolumId;
        $kullanici->unvanId = $unvanId;
        $kullanici->yetkiId = $yetkiId;
        $kullanici->save();

        // Güncellenen kullanıcıyı JSON formatında döndürme
        return response()->json($kullanici);
    }


    public function kullaniciDuzenleForm($id)
    {
        $kullanici = Kullanici::findOrFail($id);
        $bolumler = Bolum::all();
        $unvanlar = Unvan::all();
        $yetkiler = Yetki::all();
        return response()->json([
            'kullanici' => $kullanici,
            'bolumler' => $bolumler,
            'unvanlar' => $unvanlar,
            'yetkiler' => $yetkiler
        ]);
    }

    public function kullaniciSil($id)
    {
        $kullanici = Kullanici::findOrFail($id);
        $kullanici->delete();

        // Başarılı bir silme işlemi olduğunda JSON yanıtı döndürebilirsiniz:
        return response()->json(['success' => true]);

        // Veya varsayılan olarak sayfa yenileme işlemi yapılabilir:
        // return redirect()->route('admin.kullanici.listesi')->with('success', 'Kullanıcı başarıyla silindi.');
    }

    public function kullaniciEkleForm(){
        $bolumler = Bolum::all();
        $unvanlar = Unvan::all();
        $yetkiler = Yetki::all();
        return response()->json([
            'bolumler' => $bolumler,
            'unvanlar' => $unvanlar,
            'yetkiler' => $yetkiler
        ]);
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

    public function getOptions()
    {
        $bolumler = Bolum::all();
        $unvanlar = Unvan::all();
        $yetkiler = Yetki::all();
        return response()->json([
            'bolumler' => $bolumler,
            'unvanlar' => $unvanlar,
            'yetkiler' => $yetkiler
        ]);
    }
}

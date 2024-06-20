<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
        $kullanicilar = User::all(); // Tüm kullanıcıları al

        return view('kullanicilar', compact('kullanicilar'));
    }

    public function show($id)
    {
        $kullanici = User::findOrFail($id); // Kullanıcıyı id'ye göre bul

        return response()->json($kullanici); // JSON formatında kullanıcıyı döndür
    }

    public function update(Request $request, $id)
    {
        $kullanici = User::findOrFail($id); // Kullanıcıyı id'ye göre bul

        // Formdan gelen verileri güncelle
        $kullanici->mail = $request->mailEdit;
        $kullanici->ad = $request->adEdit;
        $kullanici->soyad = $request->soyadEdit;
        $kullanici->bolumId = $request->bolumIdEdit;
        $kullanici->unvanId = $request->unvanIdEdit;
        $kullanici->yetkiId = $request->yetkiIdEdit;
        $kullanici->save();

        return response()->json(['success' => true]); // Başarılı yanıt
    }

    public function store(Request $request)
    {
        // Yeni kullanıcı oluştur
        $kullanici = new User();
        $kullanici->mail = $request->mail;
        $kullanici->ad = $request->ad;
        $kullanici->soyad = $request->soyad;
        $kullanici->bolumId = $request->bolumId;
        $kullanici->unvanId = $request->unvanId;
        $kullanici->yetkiId = $request->yetkiId;
        $kullanici->save();

        return response()->json(['success' => true]); // Başarılı yanıt
    }

    public function destroy($id)
    {
        $kullanici = User::findOrFail($id); // Kullanıcıyı id'ye göre bul ve sil
        $kullanici->delete();

        return response()->json(['success' => true]); // Başarılı yanıt
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('Login/login'); // login.blade.php sayfasını yükler
    }

    public function postLogin(Request $request)
    {
        // Form verilerini al
        $mail = $request->input('mail');
        $sifre = $request->input('sifre');

        // Kullanıcıyı veritabanından sorgula
        $user = DB::table('kullanicilar')
            ->where('mail', $mail)
            ->where('sifre', $sifre)
            ->first();

        if ($user) {
            // Kullanıcı doğrulandıysa oturum başlat
            Session::put('kullanici_id', $user->id);
            Session::put('kullanici_mail', $user->mail);
            Session::put('kullanici_ad_soyad', $user->ad . ' ' . $user->soyad);
            Session::put('kullanici_yetkiId', $user->yetkiId);

            return response()->json([
                'success' => true,
                'message' => 'Giriş başarılı'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Giriş başarısız. Kullanıcı adı veya şifre hatalı.'
            ]);
        }
    }

    public function logout(){
        Session::flush();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DersProgrami;
use Illuminate\Http\Request;
use App\Models\Birim;
use App\Models\Bolum;
use App\Models\Ders;
use App\Models\Kullanici;
use App\Models\Sinif;

class HomeController extends Controller
{
    public function dersProgramiOlustur()
    {
        if (!(session('kullanici_yetkiId') == 1 || session('kullanici_yetkiId') == 2)) {
            return redirect()->route('home')->with('error', 'Bu sayfaya erişim yetkiniz yok.');
        }

        // Gerekli verileri al
        $birimler = Birim::all();
        $bolumler = Bolum::all();
        $dersler = Ders::all();
        $siniflar = Sinif::all();
        $ogretimUyeleri = Kullanici::where('yetkiId', 3)->get();

        return view('home.dersProgramiOlustur', compact(
            'birimler', 'bolumler', 'dersler', 'siniflar', 'ogretimUyeleri'
        ));
    }

    public function showDersProgramlari(Request $request)
    {
        $userYetkiId = session('kullanici_yetkiId');

        // Yetkiye göre gerekli verileri hazırla
        switch ($userYetkiId) {
            case 1: // Admin
            case 2: // Bölüm Başkanı
                $birimler = Birim::all();
                $bolumler = [];
                $siniflar = [];
                $dersProgramlari = [];
                break;
            case 3: // Öğretim Üyesi
                $ogretimUyesiId = auth()->user()->id;
                $bolumler = Bolum::whereHas('ogretimUyeleri', function ($query) use ($ogretimUyesiId) {
                    $query->where('id', $ogretimUyesiId);
                })->get();
                $dersProgramlari = DersProgrami::where('ogretimUyeId', $ogretimUyesiId)->get();
                break;
            case 4: // Öğrenci
                $ogrenciId = auth()->user()->id;
                $bolumler = Bolum::whereHas('siniflar.ogrenciler', function ($query) use ($ogrenciId) {
                    $query->where('id', $ogrenciId);
                })->get();
                $dersProgramlari = DersProgrami::whereHas('sinif.ogrenciler', function ($query) use ($ogrenciId) {
                    $query->where('id', $ogrenciId);
                })->get();
                break;
            default:
                return redirect()->route('home')->with('error', 'Bu sayfaya erişim yetkiniz yok.');
        }

        return view('home.dersProgramiGoruntule', compact('birimler', 'bolumler', 'siniflar', 'dersProgramlari'));
    }

    public function dersProgramlari(Request $request)
    {
        // Eğer birim ve bölüm seçildiyse ona göre ders programlarını getir
        if ($request->has('birimId') && $request->has('bolumId')) {
            $birimId = $request->birimId;
            $bolumId = $request->bolumId;

            $dersProgramlari = DersProgrami::whereHas('sinif', function ($query) use ($birimId, $bolumId) {
                $query->where('birimId', $birimId)->where('bolumId', $bolumId);
            })->get();

            return view('home.dersProgramlari', compact('dersProgramlari'));
        }

        // Eğer birim seçildiyse, birime göre bölümleri getir
        if ($request->has('birimId')) {
            $birimId = $request->birimId;
            $birim = Birim::find($birimId);
            $bolumler = $birim->bolumler()->get();

            return view('home.dersProgramlari', compact('birimler', 'bolumler'));
        }

        // Normal sayfa yüklendiğinde, ilk seferde birimlerin listesi gelir
        $birimler = Birim::all();
        return view('home.dersProgramlari', compact('birimler'));
    }

    public function getBolumlerByBirim($birimId)
    {
        $bolumler = Bolum::where('birimId', $birimId)->get();

        return response()->json($bolumler);
    }

    public function submitDersProgramiOlustur(Request $request)
    {
        // Kullanıcı yetkisini kontrol et
        if (!(session('kullanici_yetkiId') == 1 || session('kullanici_yetkiId') == 2)) {
            return redirect()->route('home')->with('error', 'Bu işlemi gerçekleştirme yetkiniz yok.');
        }

        // Form verilerini al
        $data = $request->only(['dersId', 'sinifId','birimId', 'ogretimUyeId', 'bolumId', 'gun', 'baslangicSaati', 'bitisSaati']);

        // Günü doğru formata dönüştür
        $data['gun'] = date('Y-m-d', strtotime($data['gun']));

        // Ders programı oluştur
        DersProgrami::create($data);

        return redirect()->route('home.dersProgramiOlustur')->with('success', 'Ders programı başarıyla oluşturuldu.');
    }
}

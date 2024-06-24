<?php

namespace App\Http\Controllers;

use App\Models\DersProgrami;
use Illuminate\Http\Request;
use App\Models\Birim;
use App\Models\Bolum;
use App\Models\Ders;
use App\Models\Kullanici;
use App\Models\Sinif;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dersProgramiGoruntule()
    {
        // Kullanıcı yetkisini kontrol et
        $yetkiId = session('kullanici_yetkiId');
        $kullaniciId = session('kullanici_id');

        // Günler ve saat aralıkları için tanımlar (aynı tanımlamaları kullanabiliriz)
        $gunler = [
            1 => 'Pazartesi',
            2 => 'Salı',
            3 => 'Çarşamba',
            4 => 'Perşembe',
            5 => 'Cuma'
        ];

        $saatAraliklari = [
            1 => '08:00 - 08:50',
            2 => '09:00 - 09:50',
            3 => '10:00 - 10:50',
            4 => '11:00 - 11:50',
            5 => '12:00 - 12:50',
            6 => '13:00 - 13:50',
            7 => '14:00 - 14:50',
            8 => '15:00 - 15:50',
            9 => '16:00 - 16:50'
        ];

        if ($yetkiId == 3) {
            // Öğretim üyesinin haftalık ders programı görüntülenecek
            $dersProgramlari = DersProgrami::where('ogretimUyeId', $kullaniciId)->orderBy('gun')->get();

            return view('home.ogretimUyesiDersProgrami', compact('dersProgramlari', 'gunler', 'saatAraliklari'));
        } elseif ($yetkiId == 4) {
            // Öğrencinin ders programı görüntülenecek
            $kullanici = Kullanici::find($kullaniciId);
            $bolumId = $kullanici->bolumId;

            // İlgili bölüm için ders programlarını getir
            $dersProgramlari = DersProgrami::where('bolumId', $bolumId)->orderBy('gun')->get();

            return view('home.dersProgramiGoster', compact('dersProgramlari', 'gunler', 'saatAraliklari'));
        } else {
            // Diğer kullanıcılar için birim ve bölüm seçme formu gösterilecek
            $birimler = Birim::all();
            $bolumler = Bolum::all();

            return view('home.birimBolumSec', compact('birimler', 'bolumler'));
        }
    }


    public function dersProgramiGoster(Request $request)
    {
        $birimId = $request->input('birimId');
        $bolumId = $request->input('bolumId');

        // Günler ve saat aralıkları için tanımlar
        $gunler = [
            1 => 'Pazartesi',
            2 => 'Salı',
            3 => 'Çarşamba',
            4 => 'Perşembe',
            5 => 'Cuma'
        ];

        $saatAraliklari = [
            1 => '08:00 - 08:50',
            2 => '09:00 - 09:50',
            3 => '10:00 - 10:50',
            4 => '11:00 - 11:50',
            5 => '12:00 - 12:50',
            6 => '13:00 - 13:50',
            7 => '14:00 - 14:50',
            8 => '15:00 - 15:50',
            9 => '16:00 - 16:50'
        ];

        // İlgili birim ve bölüm için ders programlarını getir
        $dersProgramlari = DersProgrami::where('birimId', $birimId)
            ->where('bolumId', $bolumId)
            ->orderBy('gun')
            ->get();

        return view('home.dersProgramiGoster', compact('dersProgramlari', 'gunler', 'saatAraliklari'));
    }
    public function dersProgramiOlustur(Request $request)
    {
        // Kullanıcı yetkisini kontrol et
        if (!(session('kullanici_yetkiId') == 1 || session('kullanici_yetkiId') == 2)) {
            return redirect()->route('home')->with('error', 'Bu işlemi gerçekleştirme yetkiniz yok.');
        }
        $birimler = Birim::all();
        $dersProgramlari = [];

        if ($request->has('birimId') && $request->has('bolumId') && $request->has('sinifId') && $request->has('ogretimUyesiId') && $request->has('dersId')) {
            $birimId = $request->birimId;
            $bolumId = $request->bolumId;
            $sinifId = $request->sinifId;
            $ogretimUyesiId = $request->ogretimUyesiId;
            $dersId = $request->dersId;

            $dersProgramlari = DersProgrami::whereHas('sinif', function ($query) use ($birimId, $bolumId, $sinifId, $ogretimUyesiId, $dersId) {
                $query->where('birimId', $birimId)
                    ->where('bolumId', $bolumId)
                    ->where('id', $sinifId)
                    ->where('ogretimUyeId', $ogretimUyesiId)
                    ->where('dersId', $dersId);
            })->get();
        }

        return view('home.dersProgramiOlustur', compact('birimler', 'dersProgramlari'));
    }

    public function getBolumlerByBirim($birimId)
    {
        $bolumler = Bolum::where('birimId', $birimId)->get();
        return response()->json($bolumler);
    }

    public function getDerslerByBolum($bolumId)
    {
        $dersler = Ders::where('bolumId', $bolumId)->get();
        return response()->json($dersler);
    }

    public function getSiniflar()
    {
        $siniflar = Sinif::all();
        return response()->json($siniflar);
    }

    public function getOgretimUyeleri()
    {
        $ogretimUyeleri = Kullanici::where('yetkiId', 3)->get();
        return response()->json($ogretimUyeleri);
    }

    public function submitDersProgramiOlustur(Request $request)
    {
        // Kullanıcı yetkisini kontrol et
        if (!(session('kullanici_yetkiId') == 1 || session('kullanici_yetkiId') == 2)) {
            return redirect()->back()->with('error', 'Bu işlemi gerçekleştirme yetkiniz yok.');
        }

        // Form verilerini doğrula
        $validatedData = $request->validate([
            'birimId' => 'required',
            'bolumId' => 'required',
            'sinifId' => 'required',
            'ogretimUyesiId' => 'required',
            'dersId' => 'required',
            'gun' => 'required|int',
            'saatAraligi' => 'required|array', // 'saatAraligi' adında bir dizi bekler
            'saatAraligi.*' => 'required|integer', // Her elemanın integer olup olmadığını kontrol et
        ]);

        // Çakışma kontrolü - sınıf ve saat aralığı
        foreach ($validatedData['saatAraligi'] as $saatAraligi) {
            $conflictingDers = DB::table('dersprogram')
                ->where('sinifId', $validatedData['sinifId'])
                ->where('saatAraligi', $saatAraligi)
                ->first();

            if ($conflictingDers) {
                return redirect()->back()->withInput()->with('error', 'Seçilen saat aralığından biri için ilgili sınıfta ders vardır. Ders oluşturamazsınız.');
            }
        }

        // Öğretim üyesinin aynı saat aralığında başka bir dersi var mı kontrolü
        foreach ($validatedData['saatAraligi'] as $saatAraligi) {
            $conflictingOgretimUyesiDers = DB::table('dersprogram')
                ->where('ogretimUyeId', $validatedData['ogretimUyesiId'])
                ->where('gun', $validatedData['gun'])
                ->where('saatAraligi', $saatAraligi)
                ->first();

            if ($conflictingOgretimUyesiDers) {
                return redirect()->back()->withInput()->with('error', 'Seçilen saat aralığından biri için öğretim üyesinin dersi bulunmaktadır. Ders oluşturamazsınız.');
            }
        }

        // Veriyi kaydetme
        foreach ($validatedData['saatAraligi'] as $saatAraligi) {
            DB::table('dersprogram')->insert([
                'birimId' => $validatedData['birimId'],
                'bolumId' => $validatedData['bolumId'],
                'sinifId' => $validatedData['sinifId'],
                'ogretimUyeId' => $validatedData['ogretimUyesiId'],
                'dersId' => $validatedData['dersId'],
                'gun' => $validatedData['gun'],
                'saatAraligi' => $saatAraligi,
            ]);
        }

        return redirect()->back()->with('success', 'Ders programı başarıyla oluşturuldu.');
    }


}

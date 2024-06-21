<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bolum;
use App\Models\Birim;

class BolumController extends Controller
{
    public function index()
    {
        $bolumler = Bolum::with('birim')->get();
        $birimler = Birim::all();
        return view('admin.bolumler', compact('bolumler', 'birimler'));
    }

    public function edit($id)
    {
        $bolum = Bolum::find($id);
        if (!$bolum) {
            return response()->json(['error' => 'Bölüm bulunamadı.'], 404);
        }

        return response()->json(['bolum' => $bolum]);
    }

    public function update(Request $request, $id)
    {
        $bolum = Bolum::find($id);
        if (!$bolum) {
            return response()->json(['error' => 'Bölüm bulunamadı.'], 404);
        }

        $bolum->bolumKodu = $request->bolumKoduEdit;
        $bolum->bolumAd = $request->bolumAdEdit;
        $bolum->birimId = $request->birimIdEdit;
        $bolum->save();

        return response()->json(['success' => 'Bölüm başarıyla güncellendi.']);
    }

    public function store(Request $request)
    {
        $bolum = new Bolum();
        $bolum->bolumKodu = $request->bolumKodu;
        $bolum->bolumAd = $request->bolumAd;
        $bolum->birimId = $request->birimId;
        $bolum->save();

        return response()->json(['success' => 'Yeni bölüm başarıyla eklendi.']);
    }

    public function destroy($id)
    {
        $bolum = Bolum::find($id);
        if (!$bolum) {
            return response()->json(['error' => 'Bölüm bulunamadı.'], 404);
        }

        $bolum->delete();

        return response()->json(['success' => 'Bölüm başarıyla silindi.']);
    }
}

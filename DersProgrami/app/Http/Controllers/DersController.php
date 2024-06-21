<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ders;
use App\Models\Bolum;
use App\Models\Kullanici;

class DersController extends Controller
{
    public function index()
    {
        $dersler = Ders::with('bolum')->get();
        $bolumler = Bolum::all();
        return view('admin.dersler', compact('dersler', 'bolumler'));
    }

    public function store(Request $request)
    {
        $ders = new Ders();
        $ders->bolumId = $request->bolumId;
        $ders->dersKodu = $request->dersKodu;
        $ders->dersAdi = $request->dersAdi;
        $ders->dersSaati = $request->dersSaati;
        $ders->save();

        return response()->json(['success' => 'Yeni ders başarıyla eklendi.']);
    }

    public function edit($id)
    {
        $ders = Ders::find($id);
        if (!$ders) {
            return response()->json(['error' => 'Ders bulunamadı.'], 404);
        }

        return response()->json(['ders' => $ders]);
    }

    public function update(Request $request, $id)
    {
        $ders = Ders::find($id);
        if (!$ders) {
            return response()->json(['error' => 'Ders bulunamadı.'], 404);
        }

        $ders->bolumId = $request->bolumIdEdit;
        $ders->dersKodu = $request->dersKoduEdit;
        $ders->dersAdi = $request->dersAdiEdit;
        $ders->dersSaati = $request->dersSaatiEdit;
        $ders->save();

        return response()->json(['success' => 'Ders başarıyla güncellendi.']);
    }

    public function destroy($id)
    {
        $ders = Ders::find($id);
        if (!$ders) {
            return response()->json(['error' => 'Ders bulunamadı.'], 404);
        }

        $ders->delete();

        return response()->json(['success' => 'Ders başarıyla silindi.']);
    }
}

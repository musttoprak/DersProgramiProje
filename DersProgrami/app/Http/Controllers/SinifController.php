<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sinif;

class SinifController extends Controller
{
    public function index()
    {
        $siniflar = Sinif::all();
        return view('admin.siniflar', compact('siniflar'));
    }

    public function edit($id)
    {
        $sinif = Sinif::find($id);
        if (!$sinif) {
            return response()->json(['error' => 'Sınıf bulunamadı.'], 404);
        }

        return response()->json(['sinif' => $sinif]);
    }

    public function update(Request $request, $id)
    {
        $sinif = Sinif::find($id);
        if (!$sinif) {
            return response()->json(['error' => 'Sınıf bulunamadı.'], 404);
        }

        $sinif->sinifAd = $request->sinifAdEdit;
        $sinif->kapasite = $request->kapasiteEdit;
        $sinif->save();

        return response()->json(['success' => 'Sınıf başarıyla güncellendi.']);
    }

    public function store(Request $request)
    {
        $sinif = new Sinif();
        $sinif->sinifAd = $request->sinifAd;
        $sinif->kapasite = $request->kapasite;
        $sinif->save();

        return response()->json(['success' => 'Yeni sınıf başarıyla eklendi.']);
    }

    public function destroy($id)
    {
        $sinif = Sinif::find($id);
        if (!$sinif) {
            return response()->json(['error' => 'Sınıf bulunamadı.'], 404);
        }

        $sinif->delete();

        return response()->json(['success' => 'Sınıf başarıyla silindi.']);
    }
}


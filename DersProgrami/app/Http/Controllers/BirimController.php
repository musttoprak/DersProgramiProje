<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Birim;


class BirimController extends Controller
{
    public function index()
    {
        $birimler = Birim::all();
        return view('admin.birimler', compact('birimler'));
    }

    public function edit($id)
    {
        $birim = Birim::find($id);
        if (!$birim) {
            return response()->json(['error' => 'Birim bulunamadı.'], 404);
        }

        return response()->json(['birim' => $birim]);
    }

    public function update(Request $request, $id)
    {
        $birim = Birim::find($id);
        if (!$birim) {
            return response()->json(['error' => 'Birim bulunamadı.'], 404);
        }

        $birim->birimKodu = $request->birimKoduEdit;
        $birim->birimAd = $request->birimAdEdit;
        $birim->save();

        return response()->json(['success' => 'Birim başarıyla güncellendi.']);
    }

    public function store(Request $request)
    {
        $birim = new Birim();
        $birim->birimKodu = $request->birimKodu;
        $birim->birimAd = $request->birimAd;
        $birim->save();

        return response()->json(['success' => 'Yeni birim başarıyla eklendi.']);
    }

    public function destroy($id)
    {
        $birim = Birim::find($id);
        if (!$birim) {
            return response()->json(['error' => 'Birim bulunamadı.'], 404);
        }

        $birim->delete();

        return response()->json(['success' => 'Birim başarıyla silindi.']);
    }
}

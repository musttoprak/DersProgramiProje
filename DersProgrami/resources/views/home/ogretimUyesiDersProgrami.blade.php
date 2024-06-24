@extends('layouts.app') <!-- Varsayılan layout -->
@section('title', 'Birim Bölüm Seç')
@section('titleParent', 'Öğretim Üyesi Ders Programı')
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Saat Aralığı / Gün</th>
                @foreach ($gunler as $gun => $gunAdi)
                    <th>{{ $gunAdi }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($saatAraliklari as $saatAraligiId => $saatAraligiAdi)
                <tr>
                    <td>{{ $saatAraligiAdi }}</td>
                    @foreach ($gunler as $gun => $gunAdi)
                        <td>
                            <ul>
                                @foreach ($dersProgramlari->where('gun', $gun)->where('saatAraligi', $saatAraligiId) as $ders)
                                    <li>
                                        <strong>{{ $ders->ders->dersAdi }}</strong><br>
                                        Sınıf: {{ $ders->sinif->sinifAd }}<br>
                                        Birim: {{ $ders->birim->birimAd }}<br>
                                        Bölüm: {{ $ders->bolum->bolumAd }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

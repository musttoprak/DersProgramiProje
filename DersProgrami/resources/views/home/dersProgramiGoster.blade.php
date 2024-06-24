@extends('layouts.app') <!-- Varsayılan layout -->
@section('title', 'Ders Programı Görüntüle')
@section('titleParent', 'Anasayfa')
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th></th> <!-- Boş başlık sütunu -->
                @foreach ($gunler as $gun => $gunAdi)
                    <th>{{ $gunAdi }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach ($saatAraliklari as $saatAraligiId => $saatAraligiAdi)
                <tr>
                    <td>{{ $saatAraligiAdi }}</td> <!-- Saat aralığı başlığı -->
                    @foreach ($gunler as $gun => $gunAdi)
                        <td>
                            @php
                                $dersler = $dersProgramlari->where('gun', $gun)->where('saatAraligi', $saatAraligiId);
                            @endphp
                            @if ($dersler->count() > 0)
                                @foreach ($dersler as $key => $ders)
                                    <div>
                                        <strong>{{ $ders->ders->dersAdi }}</strong><br>
                                        Sınıf: {{ $ders->sinif->sinifAd }}<br>
                                        Birim: {{ $ders->birim->birimAd }}<br>
                                        Bölüm: {{ $ders->bolum->bolumAd }}
                                    </div>
                                    @if ($key < $dersler->count() - 1)
                                        <hr style="border-top: 1px solid #ccc; margin: 5px 0;">
                                    @endif
                                @endforeach
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@extends('layouts.app') <!-- Varsayılan layout -->
@section('title', 'Birim Bölüm Seç')
@section('titleParent', 'Anasayfa')
@section('content')
    <div class="container">
        <form action="{{ route('home.dersProgramiGoster') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="birimId">Birim:</label>
                <select name="birimId" id="birimId" class="form-control">
                    @foreach ($birimler as $birim)
                        <option value="{{ $birim->birimId }}">{{ $birim->birimAd }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="bolumId">Bölüm:</label>
                <select name="bolumId" id="bolumId" class="form-control">
                    @foreach ($bolumler as $bolum)
                        <option value="{{ $bolum->bolumId }}">{{ $bolum->bolumAd }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ders Programını Görüntüle</button>
        </form>
    </div>
@endsection

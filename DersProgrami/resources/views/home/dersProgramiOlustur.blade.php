@extends('layouts.app')

@section('title', 'Ders Programı Oluştur')

@section('content')
    <div class="container mt-5">
        <h2>Ders Programı Oluştur</h2>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('home.dersProgramiOlustur.submit') }}">
            @csrf
            <div class="form-group">
                <label for="birimId">Birim</label>
                <select class="form-control" id="birimId" name="birimId" required>
                    @foreach($birimler as $birim)
                        <option value="{{ $birim->birimId }}">{{ $birim->birimAd }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="bolumId">Bölüm</label>
                <select class="form-control" id="bolumId" name="bolumId" required>
                    @foreach($bolumler as $bolum)
                        <option value="{{ $bolum->bolumId }}">{{ $bolum->bolumAd }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="dersId">Ders</label>
                <select class="form-control" id="dersId" name="dersId" required>
                    @foreach($dersler as $ders)
                        <option value="{{ $ders->dersId }}">{{ $ders->dersAdi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="sinifId">Sınıf</label>
                <select class="form-control" id="sinifId" name="sinifId" required>
                    @foreach($siniflar as $sinif)
                        <option value="{{ $sinif->sinifId }}">{{ $sinif->sinifAd }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="ogretimUyeId">Öğretim Üyesi</label>
                <select class="form-control" id="ogretimUyeId" name="ogretimUyeId" required>
                    @foreach($ogretimUyeleri as $ogretimUye)
                        <option value="{{ $ogretimUye->id }}">{{ $ogretimUye->ad }}{{ $ogretimUye->soyad }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="gun">Gün</label>
                <input type="date" class="form-control" id="gun" name="gun" required>
            </div>
            <div class="form-group">
                <label for="baslangicSaati">Başlangıç Saati</label>
                <input type="time" class="form-control" id="baslangicSaati" name="baslangicSaati" required>
            </div>
            <div class="form-group">
                <label for="bitisSaati">Bitiş Saati</label>
                <input type="time" class="form-control" id="bitisSaati" name="bitisSaati" required>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Programı Oluştur</button>
        </form>
    </div>
@endsection

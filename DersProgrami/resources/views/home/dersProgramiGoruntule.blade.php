@extends('layouts.app')

@section('title', 'Ders Programı Görüntüle')

@section('content')
    <div class="container mt-5">
        <h2>Ders Programlarını Görüntüle</h2>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (count($birimler) > 0)
            <form method="GET" action="{{ route('home.dersProgramlari') }}">
                <div class="form-group">
                    <label for="birimId">Birim Seçin</label>
                    <select class="form-control" id="birimId" name="birimId">
                        <option value="">Tüm Birimler</option>
                        @foreach($birimler as $birim)
                            <option value="{{ $birim->id }}" {{ request('birimId') == $birim->id ? 'selected' : '' }}>{{ $birim->birimAd }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="bolumSecim">
                    <label for="bolumId">Bölüm Seçin</label>
                    <select class="form-control" id="bolumId" name="bolumId" {{ !request('birimId') ? 'disabled' : '' }}>
                        <option value="">Tüm Bölümler</option>
                        @if (isset($bolumler))
                            @foreach($bolumler as $bolum)
                                <option value="{{ $bolum->id }}" {{ request('bolumId') == $bolum->id ? 'selected' : '' }}>{{ $bolum->bolumAd }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filtrele</button>
            </form>
        @endif

        @if(count($dersProgramlari) > 0)
            <div class="mt-4">
                <h4>Ders Programları</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Ders Adı</th>
                        <th>Bölüm</th>
                        <th>Sınıf</th>
                        <th>Gün</th>
                        <th>Başlangıç Saati</th>
                        <th>Bitiş Saati</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dersProgramlari as $dersProgrami)
                        <tr>
                            <td>{{ $dersProgrami->ders->dersAdi }}</td>
                            <td>{{ $dersProgrami->sinif->bolum->bolumAd }}</td>
                            <td>{{ $dersProgrami->sinif->sinifAd }}</td>
                            <td>{{ $dersProgrami->gun }}</td>
                            <td>{{ $dersProgrami->baslangicSaati }}</td>
                            <td>{{ $dersProgrami->bitisSaati }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="mt-4">
                <p>Henüz ders programı bulunmamaktadır.</p>
            </div>
        @endif
    </div>
    <script>
        document.getElementById('birimId').addEventListener('change', function() {
            var birimId = this.value;
            var bolumSecimDiv = document.getElementById('bolumSecim');

            // Eğer birim seçilmişse, ilgili bölümleri getir ve dropdown'u göster
            if (birimId) {
                fetch('/api/bolumler/' + birimId)
                    .then(response => response.json())
                    .then(data => {
                        var bolumIdSelect = document.createElement('select');
                        bolumIdSelect.setAttribute('class', 'form-control');
                        bolumIdSelect.setAttribute('id', 'bolumId');
                        bolumIdSelect.setAttribute('name', 'bolumId');

                        var defaultOption = document.createElement('option');
                        defaultOption.setAttribute('value', '');
                        defaultOption.textContent = 'Tüm Bölümler';
                        bolumIdSelect.appendChild(defaultOption);

                        data.forEach(function(bolum) {
                            var option = document.createElement('option');
                            option.setAttribute('value', bolum.id);
                            option.textContent = bolum.bolumAd;
                            if ("{{ request('bolumId') }}" == bolum.id) {
                                option.setAttribute('selected', 'selected');
                            }
                            bolumIdSelect.appendChild(option);
                        });

                        // Eski bolumId dropdown'unu kaldır ve yeni oluşturulanı ekle
                        bolumSecimDiv.innerHTML = '';
                        bolumSecimDiv.appendChild(bolumIdSelect);
                        bolumSecimDiv.style.display = 'block';
                    })
                    .catch(error => console.error('Bolumler getirme hatası:', error));
            } else {
                // Eğer birim seçilmediyse, bölüm dropdown'u gizle
                bolumSecimDiv.style.display = 'none';
            }
        });
    </script>

@endsection

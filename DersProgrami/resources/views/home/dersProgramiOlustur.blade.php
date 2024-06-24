@extends('layouts.app')

@section('title', 'Ders Programı Oluştur')
@section('titleParent', 'Anasayfa')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container mt-5">
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

        @if (count($birimler) > 0)
            <form action="/home/dersProgramiOlusturSubmit" method="POST">
                @csrf
                <div class="form-group">
                    <label for="birimId">Birim Seçin</label>
                    <select class="form-control" id="birimId" name="birimId">
                        <option value="">Tüm Birimler</option>
                        @foreach($birimler as $birim)
                            <option value="{{ $birim->birimId }}">{{ $birim->birimAd }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" id="bolumSecim" style="display: none;">
                    <label for="bolumId">Bölüm Seçin</label>
                    <select class="form-control" id="bolumId" name="bolumId">
                    </select>
                </div>

                <div class="form-group" id="sinifSecim" style="display: none;">
                    <label for="sinifId">Sınıf Seçin</label>
                    <select class="form-control" id="sinifId" name="sinifId">
                    </select>
                </div>

                <div class="form-group" id="ogretimUyesiSecim" style="display: none;">
                    <label for="ogretimUyesiId">Öğretim Üyesi Seçin</label>
                    <select class="form-control" id="ogretimUyesiId" name="ogretimUyesiId">
                    </select>
                </div>

                <div class="form-group" id="dersSecim" style="display: none;">
                    <label for="dersId">Ders Seçin</label>
                    <select class="form-control" id="dersId" name="dersId">
                    </select>
                </div>
                <div class="form-group" id="gunSecim" style="display: none;">
                    <label for="gun">Gün Seçin</label>
                    <select class="form-control" id="gun" name="gun">
                        <option value="">Gün Seçin</option>
                        <option value="1">Pazartesi</option>
                        <option value="2">Salı</option>
                        <option value="3">Çarşamba</option>
                        <option value="4">Perşembe</option>
                        <option value="5">Cuma</option>
                    </select>
                </div>
                <div class="form-group" id="saatAraligiSecim" style="display: none;">
                    <fieldset>
                        <label for="saatAraligi">Saat Aralığı Seçiniz</label>
                        <div>
                            <input type="checkbox" id="saatAraligi1" name="saatAraligi[]" value="1">
                            <label for="saatAraligi1">08:00 - 08:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi2" name="saatAraligi[]" value="2">
                            <label for="saatAraligi2">09:00 - 09:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi3" name="saatAraligi[]" value="3">
                            <label for="saatAraligi3">10:00 - 10:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi4" name="saatAraligi[]" value="4">
                            <label for="saatAraligi4">11:00 - 11:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi5" name="saatAraligi[]" value="5">
                            <label for="saatAraligi5">12:00 - 12:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi6" name="saatAraligi[]" value="6">
                            <label for="saatAraligi6">13:00 - 13:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi7" name="saatAraligi[]" value="7">
                            <label for="saatAraligi7">14:00 - 14:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi8" name="saatAraligi[]" value="8">
                            <label for="saatAraligi8">15:00 - 15:50</label>
                        </div>
                        <div>
                            <input type="checkbox" id="saatAraligi9" name="saatAraligi[]" value="9">
                            <label for="saatAraligi9">16:00 - 16:50</label>
                        </div>
                    </fieldset>
                </div>

                <button type="submit" class="btn btn-primary">Ders Programı Oluştur</button>
            </form>
        @endif
    </div>
    <script>
        document.getElementById('birimId').addEventListener('change', function () {
            var birimId = this.value;
            var bolumSecimDiv = document.getElementById('bolumSecim');
            var bolumIdSelect = document.getElementById('bolumId');
            if (birimId) {
                fetch('/api/bolumler/' + birimId)
                    .then(response => response.json())
                    .then(data => {
                        bolumIdSelect.innerHTML = '<option value="">Tüm Bölümler</option>';
                        data.forEach(function (bolum) {
                            bolumIdSelect.innerHTML += `<option value="${bolum.bolumId}">${bolum.bolumAd}</option>`;
                        });
                        bolumSecimDiv.style.display = 'block';
                    })
                    .catch(error => console.error('Bolumler getirme hatası:', error));
            } else {
                bolumSecimDiv.style.display = 'none';
            }
        });

        document.getElementById('bolumId').addEventListener('change', function () {
            var bolumId = this.value;
            var sinifSecimDiv = document.getElementById('sinifSecim');
            var sinifIdSelect = document.getElementById('sinifId');
            var dersSecimDiv = document.getElementById('dersSecim');
            var dersIdSelect = document.getElementById('dersId');
            var ogretimUyesiSecimDiv = document.getElementById('ogretimUyesiSecim');
            var ogretimUyesiIdSelect = document.getElementById('ogretimUyesiId');
            var gunSecimDiv = document.getElementById('gunSecim');
            var saatAraligiSecimDiv = document.getElementById('saatAraligiSecim');

            if (bolumId) {
                fetch('/api/dersler/' + bolumId)
                    .then(response => response.json())
                    .then(data => {
                        dersIdSelect.innerHTML = '<option value="">Tüm Dersler</option>';
                        data.forEach(function (ders) {
                            dersIdSelect.innerHTML += `<option value="${ders.dersId}">${ders.dersAdi}</option>`;
                        });
                        dersSecimDiv.style.display = 'block';
                    })
                    .catch(error => console.error('Dersler getirme hatası:', error));

                fetch('/api/siniflar')
                    .then(response => response.json())
                    .then(data => {
                        sinifIdSelect.innerHTML = '<option value="">Tüm Sınıflar</option>';
                        data.forEach(function (sinif) {
                            sinifIdSelect.innerHTML += `<option value="${sinif.sinifId}">${sinif.sinifAd}</option>`;
                        });
                        sinifSecimDiv.style.display = 'block';
                    })
                    .catch(error => console.error('Siniflar getirme hatası:', error));

                fetch('/api/ogretimUyeleri')
                    .then(response => response.json())
                    .then(data => {
                        ogretimUyesiIdSelect.innerHTML = '<option value="">Tüm Öğretim Üyeleri</option>';
                        data.forEach(function (ogretimUyesi) {
                            ogretimUyesiIdSelect.innerHTML += `<option value="${ogretimUyesi.id}">${ogretimUyesi.ad} ${ogretimUyesi.soyad}</option>`;
                        });
                        ogretimUyesiSecimDiv.style.display = 'block';
                    })
                    .catch(error => console.error('Öğretim Üyeleri getirme hatası:', error));

                gunSecimDiv.style.display = 'block';
                saatAraligiSecimDiv.style.display = 'block';
            } else {
                sinifSecimDiv.style.display = 'none';
                dersSecimDiv.style.display = 'none';
                ogretimUyesiSecimDiv.style.display = 'none';
                gunSecimDiv.style.display = 'none';
                saatAraligiSecimDiv.style.display = 'none';
            }
        });

        document.getElementById('dersProgramiForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var form = document.getElementById('dersProgramiForm');
            var formData = new FormData(form);

            var birimId = formData.get('birimId');
            var bolumId = formData.get('bolumId');
            var sinifId = formData.get('sinifId');
            var ogretimUyesiId = formData.get('ogretimUyesiId');
            var dersId = formData.get('dersId');
            var gun = formData.get('gun');
            var baslangicSaati = formData.get('baslangicSaati');
            var bitisSaati = formData.get('bitisSaati');

            if (birimId && bolumId && sinifId && ogretimUyesiId && dersId && gun && baslangicSaati && bitisSaati) {
                $.ajax({
                    url: '/home/dersProgramiOlusturSubmit',
                    type: 'POST',
                    data: formData,
                    processData: false, // FormData nesnesini jQuery işlemesinden geçirmeyi devre dışı bırakır
                    contentType: false, // Otomatik olarak içerik türünü ayarlamayı devre dışı bırakır
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {
                        if (data.success) {
                            $('#dersProgramiForm')[0].reset(); // Formu temizle
                            $('.alert').remove(); // Mevcut alert mesajlarını kaldır

                            // Başarı mesajını göster
                            $('form').before('<div class="alert alert-success">' + data.message + '</div>');
                        } else {
                            // Hata mesajını göster
                            $('.alert').remove(); // Mevcut alert mesajlarını kaldır
                            $('form').before('<div class="alert alert-danger">' + data.message + '</div>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Ders programı oluşturma hatası:', error);
                    }
                });
            } else {
                console.error('Lütfen tüm alanları doldurunuz.');
            }
        });

    </script>
@endsection

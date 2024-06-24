@extends('layouts.app')
@section('title', 'Dersler')
@section('titleParent', 'Admin')
@section('content')
    <div class="container">
        <button id="addDersModalBtn" class="btn btn-primary mb-3">Yeni Ders Ekle</button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Ders Kodu</th>
                <th scope="col">Ders Adı</th>
                <th scope="col">Bölüm</th>
                <th scope="col">Ders Saati</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dersler as $ders)
                <tr>
                    <td>{{ $ders->dersKodu }}</td>
                    <td>{{ $ders->dersAdi }}</td>
                    <td>{{ $ders->bolum->bolumAd }}</td>
                    <td>{{ $ders->dersSaati }}</td>
                    <td>
                        <button class="btn btn-success editDersModalBtn" data-id="{{ $ders->dersId }}">Düzenle</button>
                        <button class="btn btn-danger deleteDersBtn" data-id="{{ $ders->dersId }}">Sil</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Ders Ekle Modal -->
    <div class="modal fade" id="addDersModal" tabindex="-1" aria-labelledby="addDersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDersModalLabel">Yeni Ders Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="dersForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="dersKodu" class="form-label">Ders Kodu</label>
                            <input type="text" class="form-control" id="dersKodu" name="dersKodu" required>
                        </div>
                        <div class="mb-3">
                            <label for="dersAdi" class="form-label">Ders Adı</label>
                            <input type="text" class="form-control" id="dersAdi" name="dersAdi" required>
                        </div>
                        <div class="mb-3">
                            <label for="bolumId" class="form-label">Bölüm</label>
                            <select class="form-control" id="bolumId" name="bolumId" required>
                                @foreach($bolumler as $bolum)
                                    <option value="{{ $bolum->bolumId }}">{{ $bolum->bolumAd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dersSaati" class="form-label">Ders Saati</label>
                            <input type="text" class="form-control" id="dersSaati" name="dersSaati" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ders Düzenle Modal -->
    <div class="modal fade" id="editDersModal" tabindex="-1" aria-labelledby="editDersModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDersModalLabel">Ders Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="dersFormEdit">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="dersKoduEdit" class="form-label">Ders Kodu</label>
                            <input type="text" class="form-control" id="dersKoduEdit" name="dersKoduEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="dersAdiEdit" class="form-label">Ders Adı</label>
                            <input type="text" class="form-control" id="dersAdiEdit" name="dersAdiEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="bolumIdEdit" class="form-label">Bölüm</label>
                            <select class="form-control" id="bolumIdEdit" name="bolumIdEdit" required>
                                @foreach($bolumler as $bolum)
                                    <option value="{{ $bolum->bolumId }}">{{ $bolum->bolumAd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dersSaatiEdit" class="form-label">Ders Saati</label>
                            <input type="text" class="form-control" id="dersSaatiEdit" name="dersSaatiEdit" required>
                        </div>
                        <input type="hidden" id="dersIdEdit" name="dersIdEdit">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dersler.js') }}"></script>
@endsection

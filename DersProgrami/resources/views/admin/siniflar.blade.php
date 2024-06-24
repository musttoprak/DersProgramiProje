@extends('layouts.app')
@section('title', 'Sınıflar')
@section('titleParent', 'Admin')
@section('content')
    <div class="container">
        <button id="addSinifModalBtn" class="btn btn-primary mb-3">Yeni Sınıf Ekle</button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Sınıf Adı</th>
                <th scope="col">Kapasite</th>
                <th scope="col">İşlemler</th>
            </tr>
            </thead>
            <tbody>
            @foreach($siniflar as $sinif)
                <tr>
                    <td>{{ $sinif->sinifAd }}</td>
                    <td>{{ $sinif->kapasite }}</td>
                    <td>
                        <button class="btn btn-success editSinifModalBtn" data-id="{{ $sinif->sinifId }}">Düzenle</button>
                        <button class="btn btn-danger deleteSinifBtn" data-id="{{ $sinif->sinifId }}">Sil</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Sınıf Ekle Modal -->
    <div class="modal fade" id="addSinifModal" tabindex="-1" aria-labelledby="addSinifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSinifModalLabel">Yeni Sınıf Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="sinifForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sinifAd" class="form-label">Sınıf Adı</label>
                            <input type="text" class="form-control" id="sinifAd" name="sinifAd" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasite" class="form-label">Kapasite</label>
                            <input type="number" class="form-control" id="kapasite" name="kapasite" required>
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

    <!-- Sınıf Düzenle Modal -->
    <div class="modal fade" id="editSinifModal" tabindex="-1" aria-labelledby="editSinifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSinifModalLabel">Sınıf Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="sinifFormEdit">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sinifAdEdit" class="form-label">Sınıf Adı</label>
                            <input type="text" class="form-control" id="sinifAdEdit" name="sinifAdEdit" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasiteEdit" class="form-label">Kapasite</label>
                            <input type="number" class="form-control" id="kapasiteEdit" name="kapasiteEdit" required>
                        </div>
                        <input type="hidden" id="sinifIdEdit" name="sinifIdEdit">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/siniflar.js') }}"></script>
@endsection

@extends('layouts.app')

@section('title', 'Bölümler')

@section('content')
    <div class="container mt-5">
        <h2>Bölümler</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="addBolumModalBtn" data-action="add">
            Bölüm Ekle
        </button>
        <table class="table">
            <thead>
            <tr>
                <th>Bölüm Id</th>
                <th>Bölüm Kodu</th>
                <th>Bölüm Adı</th>
                <th>Birim Adı</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody id="bolumTableBody">
            @foreach($bolumler as $bolum)
                <tr>
                    <td>{{ $bolum->bolumId }}</td>
                    <td>{{ $bolum->bolumKodu }}</td>
                    <td>{{ $bolum->bolumAd }}</td>
                    <td>{{ $bolum->birim->birimAd }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary editBolumModalBtn" data-toggle="modal"
                                data-action="edit" data-id="{{ $bolum->bolumId }}">Düzenle
                        </button>
                        <button type="button" class="btn btn-sm btn-danger deleteBolumBtn" data-id="{{ $bolum->bolumId }}">Sil</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal - Bölüm Düzenleme -->
    <div class="modal fade" id="editBolumModal" tabindex="-1" role="dialog" aria-labelledby="editBolumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBolumModalLabel">Bölüm Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bolumFormEdit">
                        @csrf
                        <div class="form-group">
                            <label for="bolumKoduEdit">Bölüm Kodu</label>
                            <input type="text" class="form-control" id="bolumKoduEdit" name="bolumKoduEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="bolumAdEdit">Bölüm Adı</label>
                            <input type="text" class="form-control" id="bolumAdEdit" name="bolumAdEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="birimIdEdit">Birim</label>
                            <select class="form-control" id="birimIdEdit" name="birimIdEdit" required>
                                @foreach($birimler as $birim)
                                    <option value="{{ $birim->birimId }}">{{ $birim->birimAd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="bolumIdEdit" id="bolumIdEdit">
                        <button type="submit" class="btn btn-primary">Bölüm Düzenle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Bölüm Ekleme -->
    <div id="addBolumModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addBolumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBolumModalLabel">Bölüm Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bolumForm">
                        @csrf
                        <div class="form-group">
                            <label for="bolumKodu">Bölüm Kodu</label>
                            <input type="text" class="form-control" id="bolumKodu" name="bolumKodu" required>
                        </div>
                        <div class="form-group">
                            <label for="bolumAd">Bölüm Adı</label>
                            <input type="text" class="form-control" id="bolumAd" name="bolumAd" required>
                        </div>
                        <div class="form-group">
                            <label for="birimId">Birim</label>
                            <select class="form-control" id="birimId" name="birimId" required>
                                @foreach($birimler as $birim)
                                    <option value="{{ $birim->birimId }}">{{ $birim->birimAd }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Bölüm Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bolumler.js') }}"></script>
@endsection

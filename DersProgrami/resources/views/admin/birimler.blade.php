@extends('layouts.app')

@section('title', 'Birimler')

@section('content')
    <div class="container mt-5">
        <h2>Birimler</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="addBirimModalBtn" data-action="add">
            Birim Ekle
        </button>
        <table class="table">
            <thead>
            <tr>
                <th>Birim Id</th>
                <th>Birim Kodu</th>
                <th>Birim Adı</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody id="birimTableBody">
            @foreach($birimler as $birim)
                <tr>
                    <td>{{ $birim->birimId }}</td>
                    <td>{{ $birim->birimKodu }}</td>
                    <td>{{ $birim->birimAd }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary editBirimModalBtn" data-toggle="modal"
                                data-action="edit" data-id="{{ $birim->birimId }}">Düzenle
                        </button>
                        <button type="button" class="btn btn-sm btn-danger deleteBirimBtn" data-id="{{ $birim->birimId }}">Sil</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal - Birim Düzenleme -->
    <div class="modal fade" id="editBirimModal" tabindex="-1" role="dialog" aria-labelledby="editBirimModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBirimModalLabel">Birim Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="birimFormEdit">
                        @csrf
                        <div class="form-group">
                            <label for="birimKoduEdit">Birim Kodu</label>
                            <input type="text" class="form-control" id="birimKoduEdit" name="birimKoduEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="birimAdEdit">Birim Adı</label>
                            <input type="text" class="form-control" id="birimAdEdit" name="birimAdEdit" required>
                        </div>
                        <input type="hidden" name="birimIdEdit" id="birimIdEdit">
                        <button type="submit" class="btn btn-primary">Birim Düzenle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Birim Ekleme -->
    <div id="addBirimModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addBirimModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBirimModalLabel">Birim Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="birimForm">
                        @csrf
                        <div class="form-group">
                            <label for="birimKodu">Birim Kodu</label>
                            <input type="text" class="form-control" id="birimKodu" name="birimKodu" required>
                        </div>
                        <div class="form-group">
                            <label for="birimAd">Birim Adı</label>
                            <input type="text" class="form-control" id="birimAd" name="birimAd" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Birim Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/birimler.js') }}"></script>
@endsection

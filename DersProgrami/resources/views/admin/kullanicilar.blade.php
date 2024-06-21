@extends('layouts.app')

@section('title', 'Kullanıcılar')

@section('content')
    <div class="container mt-5">
        <h2>Kullanıcılar</h2>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" id="addUserModalBtn" data-action="add">
            Kullanıcı Ekle
        </button>
        <table class="table">
            <thead>
            <tr>
                <th>Mail</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Bölüm ID</th>
                <th>Ünvan ID</th>
                <th>Yetki ID</th>
                <th>İşlemler</th>
            </tr>
            </thead>
            <tbody id="userTableBody">
            @foreach($kullanicilar as $kullanici)
                <tr>
                    <td>{{ $kullanici->mail }}</td>
                    <td>{{ $kullanici->ad }}</td>
                    <td>{{ $kullanici->soyad }}</td>
                    <td>{{ $kullanici->bolumId }}</td>
                    <td>{{ $kullanici->unvanId }}</td>
                    <td>{{ $kullanici->yetkiId }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary editUserModalBtn" data-toggle="modal"
                                data-action="edit" data-id="{{ $kullanici->id }}">Düzenle
                        </button>
                        <button type="button" class="btn btn-sm btn-danger deleteUserBtn" data-id="{{ $kullanici->id }}">Sil</button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal - Kullanıcı Düzenleme -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Kullanıcı Düzenle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="kullaniciFormEdit">
                        @csrf
                        <div class="form-group">
                            <label for="mailEdit">E-posta Adresi</label>
                            <input type="email" class="form-control" id="mailEdit" name="mailEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="sifreEdit">Şifre</label>
                            <input type="password" class="form-control" id="sifreEdit" name="sifreEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="adEdit">Ad</label>
                            <input type="text" class="form-control" id="adEdit" name="adEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="soyadEdit">Soyad</label>
                            <input type="text" class="form-control" id="soyadEdit" name="soyadEdit" required>
                        </div>
                        <div class="form-group">
                            <label for="bolumIdEdit">Bölüm</label>
                            <select class="form-control" id="bolumIdEdit" name="bolumIdEdit" required></select>
                        </div>
                        <div class="form-group">
                            <label for="unvanIdEdit">Ünvan</label>
                            <select class="form-control" id="unvanIdEdit" name="unvanIdEdit" required></select>
                        </div>
                        <div class="form-group">
                            <label for="yetkiIdEdit">Yetki</label>
                            <select class="form-control" id="yetkiIdEdit" name="yetkiIdEdit" required></select>
                        </div>
                        <input type="hidden" name="userIdEdit" id="userIdEdit">
                        <button type="submit" class="btn btn-primary">Kullanıcı Düzenle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Kullanıcı Ekleme -->
    <div id="addUserModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Kullanıcı Ekle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/admin/kullanicilar/ekle" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="mail">E-posta Adresi</label>
                            <input type="email" class="form-control" id="mail" name="mail" required>
                        </div>
                        <div class="form-group">
                            <label for="sifre">Şifre</label>
                            <input type="password" class="form-control" id="sifre" name="sifre" required>
                        </div>
                        <div class="form-group">
                            <label for="ad">Ad</label>
                            <input type="text" class="form-control" id="ad" name="ad" required>
                        </div>
                        <div class="form-group">
                            <label for="soyad">Soyad</label>
                            <input type="text" class="form-control" id="soyad" name="soyad" required>
                        </div>
                        <div class="form-group">
                            <label for="bolumId">Bölüm ID</label>
                            <select class="form-control" id="bolumId" name="bolumId" required></select>
                        </div>
                        <div class="form-group">
                            <label for="unvanId">Ünvan ID</label>
                            <select class="form-control" id="unvanId" name="unvanId" required></select>
                        </div>
                        <div class="form-group">
                            <label for="yetkiId">Yetki ID</label>
                            <select class="form-control" id="yetkiId" name="yetkiId" required></select>
                        </div>
                        <button type="submit" class="btn btn-primary">Kullanıcı Ekle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/kullanicilar.js') }}"></script>
@endsection


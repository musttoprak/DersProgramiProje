<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kullanıcılar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Modal - Kullanıcı Düzenleme -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Kullanıcı Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="kullaniciFormEdit" method="post">
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
                        <label for="bolumIdEdit">Bölüm ID</label>
                        <select class="form-control" id="bolumIdEdit" name="bolumIdEdit" required></select>
                    </div>
                    <div class="form-group">
                        <label for="unvanIdEdit">Unvan ID</label>
                        <select class="form-control" id="unvanIdEdit" name="unvanIdEdit" required></select>
                    </div>
                    <div class="form-group">
                        <label for="yetkiIdEdit">Yetki ID</label>
                        <select class="form-control" id="yetkiIdEdit" name="yetkiIdEdit" required></select>
                    </div>
                    <input type="hidden" name="userIdEdit" id="userIdEdit">
                    <button type="submit" class="btn btn-primary">Kullanıcı Düzenle</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Kullanıcı Ekle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="kullaniciForm" method="post">
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
                        <label for="unvanId">Unvan ID</label>
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

<div class="container mt-5">
    <h2>Kullanıcılar</h2>
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addUserModal" data-action="add">Kullanıcı Ekle</button>
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
        <!-- Kullanıcılar buraya AJAX ile gelecek -->
        </tbody>
    </table>
</div>

<!-- Custom Scripts -->
<script src="../../js/kullanicilar.js"></script>
</body>
</html>

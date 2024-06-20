<?php
session_start();

// Kullanıcı zaten giriş yapmışsa anasayfaya yönlendir
if (isset($_SESSION['kullanici_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Giriş Yap</div>
                <div class="card-body">
                    <form id="loginForm">
                        <div class="form-group">
                            <label for="mail">E-posta adresi</label>
                            <input type="email" class="form-control" id="mail" name="mail" aria-describedby="emailHelp" placeholder="E-posta adresinizi girin">
                            <small id="emailHelp" class="form-text text-muted">E-posta adresinizi asla başkalarıyla paylaşmayacağız.</small>
                        </div>
                        <div class="form-group">
                            <label for="sifre">Şifre</label>
                            <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifrenizi girin">
                        </div>
                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); // Formun default submit işlemini engelliyoruz.

            var formData = $(this).serialize(); // Form verilerini alıyoruz.

            $.ajax({
                type: 'POST',
                url: '../../../includes/Login.php', // Login.php dosyasını çağırıyoruz
                data: {
                    action: 'login', // İşlemi belirtmek için bir action parametresi gönderiyoruz
                    formData: formData // Form verilerini gönderiyoruz
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        console.log(response);
                        window.location.href = '../index.php'; // Başarılı giriş durumunda yönlendirme
                    } else {
                        alert(response.message); // Hata mesajı göster
                    }
                },
                error: function (xhr, status, error) {
                    alert('Bir hata oluştu: ' + error); // Ajax hatası
                }
            });
        });
    });
</script>
</body>
</html>

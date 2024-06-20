<?php
session_start();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: Login/login.blade.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
          href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>
<!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Anasayfa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Nav items based on user role -->
            <?php if (isset($_SESSION['kullanici_yetkiId'])): ?>
                <?php if ($_SESSION['kullanici_yetkiId'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('admin/kullanicilar.php')">Kullanıcılar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('admin/birimler.php')">Birimler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('admin/bolumler.php')">Bölümler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('admin/dersler.php')">Dersler</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('admin/siniflar.php')">Sınıflar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('baskan/dersProgramiOlustur.php')">Ders Programı Oluşturma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('home/dersProgramiGoruntule.php')">Ders Programı Görüntüleme</a>
                    </li>
                <?php elseif ($_SESSION['kullanici_yetkiId'] == 2): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('baskan/dersProgramiOlustur')">Ders Programı Oluşturma</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('home/dersProgramiGoruntule')">Ders Programı Görüntüleme</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="loadContent('home/dersProgramiGoruntule')">Ders Programı Görüntüleme</a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('home/dersProgramiGoruntule')">Ders Programı Görüntüleme</a>
                </li>
            <?php endif; ?>
        </ul>
        <!-- User information and logout -->
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['kullanici_ad_soyad'])): ?>
                <li class="nav-item">
                    <span class="navbar-text mr-3">Hoş geldiniz, <?php echo $_SESSION['kullanici_ad_soyad']; ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Login/logout.php">
                        <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<!-- Ana İçerik -->
<div id="main-content">
</div>


<footer class="relative bg-blueGray-200 pt-8 pb-6">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap text-left lg:text-left">
            <div class="w-full lg:w-6/12 px-4">
                <h4 class="text-3xl fonat-semibold text-blueGray-700">Let's keep in touch!</h4>
                <h5 class="text-lg mt-0 mb-2 text-blueGray-600">
                    Find us on any of these platforms, we respond 1-2 business days.
                </h5>
                <div class="mt-6 lg:mb-0 mb-6">
                    <button class="bg-white text-lightBlue-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                        <i class="fab fa-twitter"></i></button>
                    <button class="bg-white text-lightBlue-600 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                        <i class="fab fa-facebook-square"></i></button>
                    <button class="bg-white text-pink-400 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                        <i class="fab fa-dribbble"></i></button>
                    <button class="bg-white text-blueGray-800 shadow-lg font-normal h-10 w-10 items-center justify-center align-center rounded-full outline-none focus:outline-none mr-2"
                            type="button">
                        <i class="fab fa-github"></i>
                    </button>
                </div>
            </div>
            <div class="w-full lg:w-6/12 px-4">
                <div class="flex flex-wrap items-top mb-6">
                    <div class="w-full lg:w-4/12 px-4 ml-auto">
                        <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Useful Links</span>
                        <ul class="list-unstyled">
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://www.creative-tim.com/presentation?ref=njs-profile">About Us</a>
                            </li>
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://blog.creative-tim.com?ref=njs-profile">Blog</a>
                            </li>
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://www.github.com/creativetimofficial?ref=njs-profile">Github</a>
                            </li>
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://www.creative-tim.com/bootstrap-themes/free?ref=njs-profile">Free
                                    Products</a>
                            </li>
                        </ul>
                    </div>
                    <div class="w-full lg:w-4/12 px-4">
                        <span class="block uppercase text-blueGray-500 text-sm font-semibold mb-2">Other Resources</span>
                        <ul class="list-unstyled">
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://github.com/creativetimofficial/notus-js/blob/main/LICENSE.md?ref=njs-profile">MIT
                                    License</a>
                            </li>
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://creative-tim.com/terms?ref=njs-profile">Terms &amp; Conditions</a>
                            </li>
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://creative-tim.com/privacy?ref=njs-profile">Privacy Policy</a>
                            </li>
                            <li>
                                <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm"
                                   href="https://creative-tim.com/contact-us?ref=njs-profile">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-blueGray-300">
        <div class="flex flex-wrap items-center md:justify-between justify-center">
            <div class="w-full md:w-4/12 px-4 mx-auto text-center">
                <div class="text-sm text-blueGray-500 font-semibold py-1">
                    Copyright © <span id="get-current-year">2021</span><a
                            href="https://www.creative-tim.com/product/notus-js"
                            class="text-blueGray-500 hover:text-gray-800" target="_blank"> Notus JS by
                        <a href="https://www.creative-tim.com?ref=njs-profile"
                           class="text-blueGray-500 hover:text-blueGray-800">Creative Tim</a>.
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    function loadContent(page) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', page + '.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                document.getElementById('main-content').innerHTML = xhr.responseText;
                // Execute scripts in the fetched content
                const scripts = document.getElementById('main-content').getElementsByTagName('script');
                for (let i = 0; i < scripts.length; i++) {
                    eval(scripts[i].innerText);
                }
            } else {
                console.error('İçerik yüklenemedi.');
            }
        };
        xhr.send();
    }

</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

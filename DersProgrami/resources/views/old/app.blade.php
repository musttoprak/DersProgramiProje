<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Anasayfa</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <!-- Nav items based on user role -->
            @if(session()->has('kullanici_yetkiId') && session('kullanici_yetkiId') == 1)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                       data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        Admin Menü
                    </a>
                    <div class="dropdown-menu" aria-labelledby="adminDropdown">
                        <a class="dropdown-item" href="/admin/kullanicilar">Kullanıcılar</a>
                        <a class="dropdown-item" href="/admin/birimler">Birimler</a>
                        <a class="dropdown-item" href="/admin/bolumler">Bölümler</a>
                        <a class="dropdown-item" href="/admin/dersler">Dersler</a>
                        <a class="dropdown-item" href="/admin/siniflar">Sınıflar</a>
                    </div>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="/home/dersProgramiOlustur">Ders Programı Oluşturma</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">Ders Programı Görüntüleme</a>
            </li>
        </ul>
        <!-- User information and logout -->
        <ul class="navbar-nav ml-auto">
            @if(session()->has('kullanici_ad_soyad'))
                <li class="nav-item">
                        <span class="navbar-text mr-3">Hoş geldiniz, {{ session('kullanici_ad_soyad') }}(@php
                                $yetkiId = session('kullanici_yetkiId');
                            echo match ($yetkiId) {
                                1 => "Admin",
                                2 => "Bölüm Başkanı",
                                3 => "Öğretim Üyesi",
                                4 => "Öğrenci",
                                default => "Misafir",
                            };
                            @endphp
                            )</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                </li>
            @endif
        </ul>

    </div>
</nav>

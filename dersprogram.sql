-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Haz 2024, 16:05:49
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dersprogram`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `birimler`
--

CREATE TABLE `birimler` (
  `birimId` int(11) NOT NULL,
  `birimKodu` varchar(2) NOT NULL,
  `birimAd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `birimler`
--

INSERT INTO `birimler` (`birimId`, `birimKodu`, `birimAd`) VALUES
(1, '1', 'Meslek Yüksekokulu'),
(2, '12', 'Eğitim Fakültesi'),
(5, '24', 'Teknoloji Fakültesi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bolumler`
--

CREATE TABLE `bolumler` (
  `bolumId` int(11) NOT NULL,
  `bolumKodu` varchar(2) NOT NULL,
  `birimId` int(11) NOT NULL,
  `bolumAd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `bolumler`
--

INSERT INTO `bolumler` (`bolumId`, `bolumKodu`, `birimId`, `bolumAd`) VALUES
(1, '08', 1, 'Bilgisayar Programcılığı'),
(2, '01', 2, 'Elektrik'),
(3, '14', 1, 'İç Mekan Tasarımı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersler`
--

CREATE TABLE `dersler` (
  `dersId` int(11) NOT NULL,
  `bolumId` int(11) NOT NULL,
  `dersKodu` varchar(255) NOT NULL,
  `dersAdi` varchar(255) NOT NULL,
  `dersSaati` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `dersler`
--

INSERT INTO `dersler` (`dersId`, `bolumId`, `dersKodu`, `dersAdi`, `dersSaati`) VALUES
(1, 1, '4308.104', 'Veri Tabani ', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dersprogram`
--

CREATE TABLE `dersprogram` (
  `dersProgramId` int(11) NOT NULL,
  `sinifId` int(11) NOT NULL,
  `birimId` int(11) NOT NULL,
  `ogretimUyeId` int(11) NOT NULL,
  `bolumId` int(11) NOT NULL,
  `dersId` int(11) NOT NULL,
  `gun` int(1) NOT NULL,
  `saatAraligi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `dersprogram`
--

INSERT INTO `dersprogram` (`dersProgramId`, `sinifId`, `birimId`, `ogretimUyeId`, `bolumId`, `dersId`, `gun`, `saatAraligi`) VALUES
(11, 1, 1, 3, 1, 1, 1, 1),
(12, 1, 1, 3, 1, 1, 1, 2),
(13, 1, 1, 3, 1, 1, 1, 3),
(14, 1, 1, 3, 1, 1, 5, 4),
(15, 1, 1, 3, 1, 1, 5, 5),
(16, 1, 1, 3, 1, 1, 5, 6),
(17, 2, 1, 3, 1, 1, 2, 1),
(18, 2, 1, 3, 1, 1, 2, 5),
(19, 2, 1, 3, 1, 1, 2, 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `ad` varchar(30) NOT NULL,
  `soyad` varchar(30) NOT NULL,
  `bolumId` int(11) NOT NULL,
  `unvanId` int(11) NOT NULL,
  `yetkiId` int(11) NOT NULL,
  `olusturmaTarihi` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `mail`, `sifre`, `ad`, `soyad`, `bolumId`, `unvanId`, `yetkiId`, `olusturmaTarihi`) VALUES
(1, 'oalkan@erzincan.edu.trrrrr', '12345', 'Okan', 'Alkan', 1, 1, 1, '2024-03-14 14:39:38'),
(2, 'celik@erzincan.edu.tr', '12345', 'Cengiz', 'Çelik', 1, 1, 2, '2024-03-14 14:39:55'),
(3, 'moguz@erzincan.edu.trasfass', '12345', 'Merve', 'Oğuz', 2, 1, 3, '2024-03-14 15:53:32'),
(23, 'wee@gmail.com', '123', '123', '123', 1, 1, 4, '2024-06-20 18:05:51'),
(25, 'mustafa@gmail.com', '123', '123', '123', 1, 7, 3, '2024-06-20 18:50:15'),
(26, 'merhaba@gmail.com', '123', 'asd', 'sg', 2, 1, 3, '2024-06-21 14:40:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sinif`
--

CREATE TABLE `sinif` (
  `sinifId` int(11) NOT NULL,
  `sinifAd` varchar(255) NOT NULL,
  `kapasite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sinif`
--

INSERT INTO `sinif` (`sinifId`, `sinifAd`, `kapasite`) VALUES
(1, 'C3-105 - Bilgisayar Lab. 2', 44),
(2, 'C3-104', 42);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `unvanlar`
--

CREATE TABLE `unvanlar` (
  `unvanId` int(11) NOT NULL,
  `unvanAd` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `unvanlar`
--

INSERT INTO `unvanlar` (`unvanId`, `unvanAd`) VALUES
(1, 'Öğr. Gör.'),
(2, 'Arş. Gör.'),
(3, 'Dr. Öğretim Üyesi'),
(4, 'Doç. Dr.'),
(5, 'Prof. Dr.'),
(6, 'Öğr. Gör. Dr.'),
(7, 'Arş. Gör. Dr.');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yetkiler`
--

CREATE TABLE `yetkiler` (
  `yetkiId` int(11) NOT NULL,
  `yetkiAd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yetkiler`
--

INSERT INTO `yetkiler` (`yetkiId`, `yetkiAd`) VALUES
(1, 'Admin'),
(2, 'Bölüm Başkanı'),
(3, 'Öğretim Üyesi'),
(4, 'Öğrenci');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `birimler`
--
ALTER TABLE `birimler`
  ADD PRIMARY KEY (`birimId`);

--
-- Tablo için indeksler `bolumler`
--
ALTER TABLE `bolumler`
  ADD PRIMARY KEY (`bolumId`),
  ADD KEY `birimId` (`birimId`);

--
-- Tablo için indeksler `dersler`
--
ALTER TABLE `dersler`
  ADD PRIMARY KEY (`dersId`),
  ADD KEY `bolumId` (`bolumId`);

--
-- Tablo için indeksler `dersprogram`
--
ALTER TABLE `dersprogram`
  ADD PRIMARY KEY (`dersProgramId`),
  ADD KEY `sinifId` (`sinifId`),
  ADD KEY `fk_dersprogram_birimId` (`birimId`),
  ADD KEY `fk_dersprogram_bolumId` (`bolumId`),
  ADD KEY `fk_dersprogram_dersId` (`dersId`),
  ADD KEY `fk_dersprogram_ogretimUyeId` (`ogretimUyeId`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD KEY `bolumId` (`bolumId`),
  ADD KEY `unvanId` (`unvanId`),
  ADD KEY `yetkiId` (`yetkiId`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Tablo için indeksler `sinif`
--
ALTER TABLE `sinif`
  ADD PRIMARY KEY (`sinifId`);

--
-- Tablo için indeksler `unvanlar`
--
ALTER TABLE `unvanlar`
  ADD PRIMARY KEY (`unvanId`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Tablo için indeksler `yetkiler`
--
ALTER TABLE `yetkiler`
  ADD PRIMARY KEY (`yetkiId`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `birimler`
--
ALTER TABLE `birimler`
  MODIFY `birimId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `bolumler`
--
ALTER TABLE `bolumler`
  MODIFY `bolumId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `dersler`
--
ALTER TABLE `dersler`
  MODIFY `dersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `dersprogram`
--
ALTER TABLE `dersprogram`
  MODIFY `dersProgramId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `sinif`
--
ALTER TABLE `sinif`
  MODIFY `sinifId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `unvanlar`
--
ALTER TABLE `unvanlar`
  MODIFY `unvanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `yetkiler`
--
ALTER TABLE `yetkiler`
  MODIFY `yetkiId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `bolumler`
--
ALTER TABLE `bolumler`
  ADD CONSTRAINT `bolumler_ibfk_1` FOREIGN KEY (`birimId`) REFERENCES `birimler` (`birimId`);

--
-- Tablo kısıtlamaları `dersler`
--
ALTER TABLE `dersler`
  ADD CONSTRAINT `dersler_ibfk_1` FOREIGN KEY (`bolumId`) REFERENCES `bolumler` (`bolumId`);

--
-- Tablo kısıtlamaları `dersprogram`
--
ALTER TABLE `dersprogram`
  ADD CONSTRAINT `fk_dersprogram_birimId` FOREIGN KEY (`birimId`) REFERENCES `birimler` (`birimId`),
  ADD CONSTRAINT `fk_dersprogram_bolumId` FOREIGN KEY (`bolumId`) REFERENCES `bolumler` (`bolumId`),
  ADD CONSTRAINT `fk_dersprogram_dersId` FOREIGN KEY (`dersId`) REFERENCES `dersler` (`dersId`),
  ADD CONSTRAINT `fk_dersprogram_ogretimUyeId` FOREIGN KEY (`ogretimUyeId`) REFERENCES `kullanicilar` (`id`);

--
-- Tablo kısıtlamaları `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD CONSTRAINT `kullanicilar_ibfk_1` FOREIGN KEY (`yetkiId`) REFERENCES `yetkiler` (`yetkiId`),
  ADD CONSTRAINT `kullanicilar_ibfk_2` FOREIGN KEY (`unvanId`) REFERENCES `unvanlar` (`unvanId`),
  ADD CONSTRAINT `kullanicilar_ibfk_3` FOREIGN KEY (`bolumId`) REFERENCES `bolumler` (`bolumId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

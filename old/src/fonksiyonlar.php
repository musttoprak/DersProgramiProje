<?php
// Web safası üzerine genel fonksiyonlar oluşturulacak
class FONK {
    public function parseUrl() {
        if(isset($_GET["url"])) {
            return explode("/", $_GET["url"]);
        }
        return null;
    }    

    public function tarihsaat($deger) {
        return date($deger);
    }

    public function goruntu($yetki="misafir", $goruntu="_404", $veri=[], $sayfa="tek") {
        if($sayfa=="sayfa") {
            require_once "sayfalar/".$yetki."/sabitler/header.php";
            require_once "sayfalar/".$yetki."/".$goruntu.".php";
            require_once "sayfalar/".$yetki."/sabitler/footer.php";
        } else if ($sayfa == "tek") {
            require_once "sayfalar/".$yetki."/".$goruntu.".php";
        }
    }

    public function getKullanicilar() {
        return DB->query("select k.*, u.unvanAd, b.bolumId, b.bolumAd, bi.birimId, bi.birimAd, y.YetkiId, y.yetkiAd from kullanicilar k
        inner join unvanlar u on k.unvanId=u.unvanId
        inner join bolumler b on b.bolumId=k.bolumId
        inner join birimler bi on b.birimId=bi.birimId
        inner join yetkiler y on y.yetkiId=k.yetkiId");
    }

    public function getKullaniciById($id) {
        return DB->query("select k.*, u.unvanAd, b.bolumId, b.bolumAd, bi.birimId, bi.birimAd, y.YetkiId, y.yetkiAd from kullanicilar k
        inner join unvanlar u on k.unvanId=u.unvanId
        inner join bolumler b on b.bolumId=k.bolumId
        inner join birimler bi on b.birimId=bi.birimId
        inner join yetkiler y on y.yetkiId=k.yetkiId
        where id=:id", 
                            array("id"=>$id));
    }

    public function getBirimler() {
        return DB->query("select * from birimler");
    }

    public function getBirimByBirimKodu($birimKodu) {
        return DB->query("select * from birimler where birimKodu=:birimKodu", 
                            array("birimKodu"=>$birimKodu));
    }

    public function getBolumler() {
        return DB->query("select * from bolumler");
    }
    public function getUnvanlar() {
        return DB->query("select * from unvanlar");
    }
    public function getYetkiler() {
        return DB->query("select * from yetkiler");
    }
}
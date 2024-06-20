<?php 

class admin extends ortak {

    public function post_kullanici_ekle() {
        $nesne = [];
        $mail = $_POST["mail"];
        $sifre = $_POST["sifre"];
        $ad = $_POST["ad"];
        $soyad = $_POST["soyad"];
        $bolumId = $_POST["bolumId"];
        $unvanId = $_POST["unvanId"];
        $yetkiId = $_POST["yetkiId"];

        $mailKontrol = DB->row("select * from kullanicilar where mail=:mail limit 1", 
                array("mail"=>$mail));
        
        if(is_array($mailKontrol)) {            
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Bu mail daha önce kullanılmıştır.";
        } else {
            $kullaniciEkle = DB->query("INSERT INTO kullanicilar (mail, sifre, ad, soyad, bolumId, unvanId, yetkiId) values (:mail, :sifre, :ad, :soyad, :bolumId, :unvanId, :yetkiId)", 
                array("mail"=>$mail, "sifre"=>$sifre, "ad"=>$ad, "soyad"=>$soyad
                , "bolumId"=>$bolumId, "unvanId"=>$unvanId, "yetkiId"=>$yetkiId));

            if($kullaniciEkle > 0) {
                $nesne["islem"] = "success";
                $nesne["mesaj"] = "Kullanıcı eklendi. Yönlendiriliyorsunuz";
            }
            else {
                $nesne["islem"] = "error";
                $nesne["mesaj"] = "Hata. Kaydetme esnasıda hata oluştu";
            }            
        }        
        echo json_encode($nesne);
    }


    public function post_kullanici_sil() {
        $nesne = [];
        $kullaniciId = $_POST["kullaniciId"];

        $kullaniciSil = DB->query("delete from kullanicilar where id=:id", 
                array("id"=>$kullaniciId));
        
        if($kullaniciSil > 0) {
            $nesne["islem"] = "success";
            $nesne["mesaj"] = "Kullanıcı silindi. Yönlendiriliyorsunuz";
        }
        else {
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Hata. Silme esnasıda hata oluştu";
        }        
        echo json_encode($nesne);
    }


    public function post_kullanici_guncelle() {
        $nesne = [];
        $id = $_POST["id"];
        $mail = $_POST["mail"];
        $sifre = $_POST["sifre"];
        $ad = $_POST["ad"];
        $soyad = $_POST["soyad"];
        $bolumId = $_POST["bolumId"];
        $unvanId = $_POST["unvanId"];
        $yetkiId = $_POST["yetkiId"];

        $mailKontrol = DB->row("select * from kullanicilar where id!=:id and mail=:mail limit 1", 
                array("id"=>$id, "mail"=>$mail));
        
        if(is_array($mailKontrol)) {            
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Bu mail daha önce kullanılmıştır.";
        } else {
            $kullaniciGuncelle = DB->query("update kullanicilar
            SET mail=:mail, sifre=:sifre, ad=:ad, soyad=:soyad, 
            bolumId=:bolumId, unvanId=:unvanId, yetkiId=:yetkiId
            where id=:id",
                array("id"=>$id, "mail"=>$mail, "sifre"=>$sifre, "ad"=>$ad, "soyad"=>$soyad
                , "bolumId"=>$bolumId, "unvanId"=>$unvanId, "yetkiId"=>$yetkiId));

            if($kullaniciGuncelle > 0) {
                $nesne["islem"] = "success";
                $nesne["mesaj"] = "Kullanıcı güncellendi. Yönlendiriliyorsunuz";
            }
            else {
                $nesne["islem"] = "error";
                $nesne["mesaj"] = "Hata. Güncelleme esnasıda hata oluştu";
            }            
        }        
        echo json_encode($nesne);
    }

    public function post_birim_ekle() {
        $nesne = [];
        $birimKodu = $_POST["birimKodu"];
        $birimAd = $_POST["birimAd"];
        

        $birimKoduKontrol = DB->row("select * from birimler where birimKodu=:birimKodu limit 1", 
                array("birimKodu"=>$birimKodu));
        
        if(is_array($birimKoduKontrol)) {            
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Bu birim kodu daha önce kullanılmıştır.";
        } else {
            $birimEkle = DB->query("INSERT INTO birimler (birimKodu, birimAd) values (:birimKodu, :birimAd)", 
                array("birimKodu"=>$birimKodu, "birimAd"=>$birimAd));

            if($birimEkle > 0) {
                $nesne["islem"] = "success";
                $nesne["mesaj"] = "Birim eklendi. Yönlendiriliyorsunuz";
            }
            else {
                $nesne["islem"] = "error";
                $nesne["mesaj"] = "Hata. Kaydetme esnasıda hata oluştu";
            }            
        }        
        echo json_encode($nesne);
    }

    public function post_birim_sil() {
        $nesne = [];
        $birimId = $_POST["birimId"];

        $birimSil = DB->query("delete from birimler where birimId=:birimId", 
                array("birimId"=>$birimId));
        
        if($birimSil > 0) {
            $nesne["islem"] = "success";
            $nesne["mesaj"] = "Birim silindi. Yönlendiriliyorsunuz";
        }
        else {
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Hata. Silme esnasıda hata oluştu";
        }        
        echo json_encode($nesne);
    }

    public function post_birim_guncelle() {
        $nesne = [];
        $birimId = $_POST["birimId"];
        $birimKodu = $_POST["birimKodu"];
        $birimAd = $_POST["birimAd"];

        $kodKontrol = DB->row("select * from birimler where birimId!=:birimId and mabirimKoduil=:birimKodu limit 1", 
                array("birimId"=>$birimId, "birimKodu"=>$birimKodu));
        
        if(is_array($birimKodu)) {            
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Bu birim kodu daha önce kullanılmıştır.";
        } else {
            $birimGuncelle = DB->query("update birimler
            SET birimKodu=:birimKodu, birimAd=:birimAd
            where birimId=:birimId",
                array("birimId"=>$birimId, "birimKodu"=>$birimKodu, "birimAd"=>$birimAd));

            if($birimGuncelle > 0) {
                $nesne["islem"] = "success";
                $nesne["mesaj"] = "Birim güncellendi. Yönlendiriliyorsunuz";
            }
            else {
                $nesne["islem"] = "error";
                $nesne["mesaj"] = "Hata. Güncelleme esnasıda hata oluştu";
            }            
        }        
        echo json_encode($nesne);
    }

    public function anasayfa() {
        FONK->goruntu("admin", "anasayfa", ["title"=>"Anasayfa"], "sayfa");
    }

    public function bolumler() {
        FONK->goruntu("admin", "bolumler", ["title"=>"Bölümler"], "sayfa");
    }

    //$birimKodu="" ifade => birimKodu'e veri gelmedi ise boş veri gir
    public function birimler($birimKodu="") {
        FONK->goruntu("admin", "birimler", ["title"=>"Birimler","birimKodu"=>$birimKodu], "sayfa");
    }

    public function kullanicilar($id=0) {
        $kullanicilar = $id==0 ? FONK->getKullanicilar() : FONK->getKullaniciById($id);        
        $bolumler = FONK->getBolumler();
        $unvanlar = FONK->getUnvanlar();
        $yetkiler = FONK->getYetkiler();
        FONK->goruntu("admin", "kullanicilar", 
            ["title"=>"Kullanıcılar", 
            "liste"=>$kullanicilar,
            "bolumler"=>$bolumler,
            "unvanlar"=>$unvanlar,
            "yetkiler"=>$yetkiler], "sayfa");
    }
}
<?php 
class misafir extends ortak {

    public function anasayfa() {
        FONK->goruntu("misafir", "anasayfa", ["title"=>"Anasayfa"], "sayfa");
    }

    public function giris_yap() {
        FONK->goruntu("misafir", "giris_yap", [], "tek");
    }

    public function post_giris_yap() {
        $nesne = [];
        $email = $_POST["email"];
        $sifre = $_POST["sifre"];

        $kullanicilar = DB->row("select * from kullanicilar where mail=:mail and sifre=:sifre limit 1", 
                array("mail"=>$email, "sifre"=>$sifre));
        
        if(is_array($kullanicilar)) {            
            $_SESSION = [
                "yetkiId" => $kullanicilar["yetkiId"],
                "adSoyad" => $kullanicilar["ad"] . " " . $kullanicilar["soyad"],
                "id" => $kullanicilar["id"],
                "mail" => $kullanicilar["mail"]
            ];
            $nesne["islem"] = "success";
            $nesne["mesaj"] = "Başarılı giriş yaptınız. Yönlendiriliyorsunuz";
        } else {
            $nesne["islem"] = "error";
            $nesne["mesaj"] = "Hatalı giriş";
        }
        //sleep(3);
        echo json_encode($nesne);
    }
}
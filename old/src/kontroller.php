<?php 
//bu sayfada yetkilendirme, sayfa yönlendirme, 
//parametre ayarları
class Kontroller {
    protected $yetki = "misafir";
    protected $metod = "anasayfa";
    protected $parametre = [];
    protected $FONK;

    //kurucu metod
    public function __construct($FONK) {
        /*
        fonksiyonlar.php dosyasının içindeki 
        FONK isimli class'ın altındaki fonksiyon olan
        parseUrl çağrıldı
        */
        $this->FONK = $FONK;

        //and $this->metod !="baslik" and $this->metod != "post_giris_yap"
        $yetkiler = array(1=>"admin", 2=>"baskan", 3=>"ogretimuyesi");
        if(isset($_SESSION["yetkiId"])) {
            $this->yetki = $yetkiler[$_SESSION["yetkiId"]];
        }
        require_once "yetkiler/ortak.php";
        require_once "yetkiler/" . $this->yetki . '.php';
        $yetkiDurum = new $this->yetki();

        $url = $FONK->parseUrl();
        if(isset($url[0])) {   
            // method_exists: ilgili sınıfta metodu ara varsa true
            // yoksa false döndürür
            if(method_exists($yetkiDurum, $url[0])) {
                $this->metod = $url[0];
                unset($url[0]);
                $this->parametre = $url ? array_values($url) : [];
            }
            else {
                $this->metod = "_404";
            }
        }              

        call_user_func_array([$yetkiDurum, $this->metod], $this->parametre);
        //ilgili metodu çalıştırmak ve parametre varsa göndermek
    }    
}
<?php
class ortak {
    //bu fonksiyon ile js dosyası oluşturdum
    public function baslik() {
        Header("content-type: application/x-javascript");
        echo 'var anadizin = "' . ANA_DIZIN . '";                
                var url = window.location.href;
                console.log("baslik geldi");';
    }

    public function cikis_yap() {
        session_destroy();        
    }

    public function _404() {
        FONK->goruntu("ortak", "_404", ["title"=>"404 Sayfası"], "tek");
    }
}
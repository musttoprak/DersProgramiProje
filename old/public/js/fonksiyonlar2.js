function surelialert(_icon, _title) {
    Swal.fire({
        icon: _icon,
        title: _title,
        showConfirmButton: false,
        timer: 2000
    });
}

function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}

function giris_yap() {
    console.log("giriş yap butonu tıklandı");
    // id şu olan nesneden veri alır
    email = document.getElementById("email").value;
    sifre = $("#sifre").val();

    if (email == "" || sifre == "") {
        surelialert("warning", "Lütfen, tüm alanları doldurunuz");
    } else {
        $("#btn_giris_yap").attr("disabled", true);
        //verileri php ye göndereceğiz
        $.post(anadizin + "post_giris_yap", {email: email, sifre: sifre}, function (nesne) {

            surelialert(nesne["islem"], nesne["mesaj"]);

            if (nesne["islem"] == "success") {
                sleep(2000).then(() => {
                    window.location.href = anadizin;
                });
            }

        }, "JSON").then(function () {
            $("#btn_giris_yap").attr("disabled", false);
        })
    }
}

function kullanici_ekle() {
    console.log("kullanici ekle butonu tıklandı");
    mail = $("#mail").val();
    sifre = $("#sifre").val();
    sifreTekrar = $("#sifreTekrar").val();
    ad = $("#ad").val();
    soyad = $("#soyad").val();
    bolumId = $("#bolumId").val();
    unvanId = $("#unvanId").val();
    yetkiId = $("#yetkiId").val();

    if (mail == "" || sifre == "" || sifreTekrar == "" || ad == "" || soyad == "" || bolumId == "-1" || unvanId == "-1" || yetkiId == "-1") {
        surelialert("warning", "Lütfen, tüm alanları doldurunuz");
    } else if (sifre != sifreTekrar) {
        surelialert("warning", "Şifreler aynı değil");
    } else {
        $("#kullanici_ekle").attr("disabled", true);
        //verileri php ye göndereceğiz
        //1. aynı maile sahip kullanıcı var mı?
        //2. ekleme işlemi yapılacak
        $.post(anadizin + "post_kullanici_ekle", {
            mail: mail,
            sifre: sifre,
            ad: ad,
            soyad: soyad,
            bolumId: bolumId,
            unvanId: unvanId,
            yetkiId: yetkiId
        }, function (nesne) {

            surelialert(nesne["islem"], nesne["mesaj"]);

            if (nesne["islem"] == "success") {
                sleep(2000).then(() => {
                    window.location.href = anadizin + "kullanicilar";
                });
                //$('#modal-kullanici-ekle').modal('hide');
            }

        }, "JSON").then(function () {
            $("#kullanici_ekle").attr("disabled", false);
        })
    }
}


function kullanici_sil(kullaniciId) {
    console.log("kullanici sil tıklandı");

    Swal.fire({
        title: "Kaydı gerçekten silmek istiyor musunuz?",
        icon: "question",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Evet",
        denyButtonText: "Hayır"
    }).then((result) => {
        if (result.isConfirmed) {//Evet
            $.post(anadizin + "post_kullanici_sil", {kullaniciId: kullaniciId}, function (nesne) {

                surelialert(nesne["islem"], nesne["mesaj"]);

                if (nesne["islem"] == "success") {
                    sleep(2000).then(() => {
                        window.location.href = anadizin + "kullanicilar";
                    });
                    //$('#modal-kullanici-ekle').modal('hide');
                }

            }, "JSON");

        } else if (result.isDenied) {//Hayır          
        }
    });
}


kullaniciGuncelleId = 0;

function kullanici_guncelle_ac(id, mail, sifre, ad, soyad, bolumId, unvanId, yetkiId) {
    //$('#g_mail').setAttribute('value', mail);
    kullaniciGuncelleId = id;
    document.getElementById("g_mail").value = mail;
    document.getElementById("g_sifre").value = sifre;
    document.getElementById("g_sifreTekrar").value = sifre;
    document.getElementById("g_ad").value = ad;
    document.getElementById("g_soyad").value = soyad;
    document.getElementById("g_bolumId").value = bolumId;
    document.getElementById("g_unvanId").value = unvanId;
    document.getElementById("g_yetkiId").value = yetkiId;

    $('#modal-kullanici-guncelle').modal('show');
}

function kullanici_guncelle() {
    // -- PHP
    // php tarafında mail daha önce kullanılmış mı kontrolü yap
    // id si şu olan kaydın verilerini yenisi ile güncelle
    console.log("kullanici güncelle butonu tıklandı");
    id = kullaniciGuncelleId;
    mail = $("#g_mail").val();
    sifre = $("#g_sifre").val();
    sifreTekrar = $("#g_sifreTekrar").val();
    ad = $("#g_ad").val();
    soyad = $("#g_soyad").val();
    bolumId = $("#g_bolumId").val();
    unvanId = $("#g_unvanId").val();
    yetkiId = $("#g_yetkiId").val();

    if (mail == "" || sifre == "" || sifreTekrar == "" || ad == "" || soyad == "" || bolumId == "-1" || unvanId == "-1" || yetkiId == "-1") {
        surelialert("warning", "Lütfen, tüm alanları doldurunuz");
    } else if (sifre != sifreTekrar) {
        surelialert("warning", "Şifreler aynı değil");
    } else {
        $("#btn_kullanici_guncelle").attr("disabled", true);
        $.post(anadizin + "post_kullanici_guncelle", {
            id: id,
            mail: mail,
            sifre: sifre,
            ad: ad,
            soyad: soyad,
            bolumId: bolumId,
            unvanId: unvanId,
            yetkiId: yetkiId
        }, function (nesne) {

            surelialert(nesne["islem"], nesne["mesaj"]);

            if (nesne["islem"] == "success") {
                sleep(2000).then(() => {
                    window.location.href = anadizin + "kullanicilar";
                });
                //$('#modal-kullanici-ekle').modal('hide');
            }

        }, "JSON").then(function () {
            $("#btn_kullanici_guncelle").attr("disabled", false);
        })
    }
}

function birim_ekle() {

    console.log("birim ekle butonu tıklandı");
    birimKodu = $("#birimKodu").val();
    birimAd = $("#birimAd").val();

    if (birimKodu == "" || birimAd == "") {
        surelialert("warning", "Lütfen, tüm alanları doldurunuz");
    } else {
        $("#birim_ekle").attr("disabled", true);
        //verileri php ye göndereceğiz
        //1. aynı birimKoda sahip kullanıcı var mı?
        //2. ekleme işlemi yapılacak
        $.post(anadizin + "post_birim_ekle", {birimKodu: birimKodu, birimAd: birimAd}, function (nesne) {

            surelialert(nesne["islem"], nesne["mesaj"]);

            if (nesne["islem"] == "success") {
                sleep(2000).then(() => {
                    window.location.href = anadizin + "birimler";
                });
                //$('#modal-kullanici-ekle').modal('hide');
            }

        }, "JSON").then(function () {
            $("#birim_ekle").attr("disabled", false);
        })
    }
}

function birim_sil(birimId) {
    console.log("birim sil tıklandı");

    Swal.fire({
        title: "Kaydı gerçekten silmek istiyor musunuz?",
        icon: "question",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Evet",
        denyButtonText: "Hayır"
    }).then((result) => {
        if (result.isConfirmed) {//Evet
            $.post(anadizin + "post_birim_sil", {birimId: birimId}, function (nesne) {

                surelialert(nesne["islem"], nesne["mesaj"]);

                if (nesne["islem"] == "success") {
                    sleep(2000).then(() => {
                        window.location.href = anadizin + "birimler";
                    });
                    //$('#modal-kullanici-ekle').modal('hide');
                }

            }, "JSON");

        } else if (result.isDenied) {//Hayır          
        }
    });
}

birimGuncelleId = 0;

function birim_guncelle_ac(birimId, birimKodu, birimAd) {
    //$('#g_mail').setAttribute('value', mail);
    birimGuncelleId = birimId;
    document.getElementById("g_birimKodu").value = birimKodu;
    document.getElementById("g_birimAd").value = birimAd;
    $('#modal-birim-guncelle').modal('show');
}

function birim_guncelle() {
    // -- PHP
    // php tarafında mail daha önce kullanılmış mı kontrolü yap
    // id si şu olan kaydın verilerini yenisi ile güncelle
    console.log("birim güncelle butonu tıklandı");
    birimId = birimGuncelleId;
    birimKodu = $("#g_birimKodu").val();
    birimAd = $("#g_birimAd").val();

    if (birimKodu == "" || birimAd == "") {
        surelialert("warning", "Lütfen, tüm alanları doldurunuz");
    } else {
        $("#btn_birim_guncelle").attr("disabled", true);
        $.post(anadizin + "post_birim_guncelle", {
            birimId: birimId,
            birimKodu: birimKodu,
            birimAd: birimAd
        }, function (nesne) {

            surelialert(nesne["islem"], nesne["mesaj"]);

            if (nesne["islem"] == "success") {
                sleep(2000).then(() => {
                    window.location.href = anadizin + "birimler";
                });
                //$('#modal-kullanici-ekle').modal('hide');
            }

        }, "JSON").then(function () {
            $("#btn_birim_guncelle").attr("disabled", false);
        })
    }
}
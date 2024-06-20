
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-birim-ekle">
    Birim Ekle
</button>
<br/>
<br/>
<table id="myTable" class="display">
    <thead>
        <tr>
            <td>Birim Id</td>
            <td>Birim Kodu</td>
            <td>Birim Adı</td>
        </tr>
    <thead>
    <tbody>
        <?php foreach (FONK->getBirimler() as $value) { ?>
            <tr>
                <td><?=$value["birimId"];?></td>
                <td><?=$value["birimKodu"];?></td>
                <td><?=$value["birimAd"];?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">İşlemler</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                        <button class="dropdown-item" onclick="birim_sil(<?=$value['birimId'];?>)">Sil</button>
                        <button class="dropdown-item" onclick="birim_guncelle_ac(<?=$value['birimId'];?>, '<?=$value['birimKodu'];?>', '<?=$value['birimAd'];?>')">Güncelle</button>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    <tbody>
</table>

<!-- Birim Ekle Modal Başlangıç -->
<div class="modal fade" id="modal-birim-ekle">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Birim Ekle Formu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">        
                <input type="text" class="form-control" id="birimKodu" placeholder="Birim Kodu giriniz..">
            </div>
            <div class="mb-3 row">
                <div class="col">                  
                    <input type="text" class="form-control" id="birimAd" placeholder="Birim Adı giriniz...">
                </div>
                
            </div>
            </div>                  
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            <button onclick="birim_ekle()" type="submit" class="btn btn-success">Kaydet</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- Kullanıcı Ekle Modal Son -->

<!-- Kullanıcı Güncelle Modal Başlangıç -->
<div class="modal fade" id="modal-birim-guncelle">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Birim Güncelleme Formu</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">            
            <div class="mb-3">        
                <input type="text" class="form-control" id="g_birimKodu" placeholder="Mail giriniz..">
            </div>
            <div class="mb-3 row">
                <div class="col">                  
                    <input type="password" class="form-control" id="g_birimAd" placeholder="Şifre giriniz...">
                </div>
        </div>
            </div>                  
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Kapat</button>
            <button id="btn_birim_guncelle" onclick="birim_guncelle()" type="submit" class="btn btn-success">                
                Güncelle
            </button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- Kullanıcı Güncelle Modal Son -->
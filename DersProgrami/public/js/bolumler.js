$(document).ready(function () {
// Bölüm Ekleme
    $('#bolumForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "/admin/bolumler",
            type: "POST",
            data: formData,
            success: function(response) {
                toastr.success("Başarılı bir şekilde eklendi");
                $('#addBolumModal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr) {
                toastr.warning('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });

// Bölüm Düzenleme
    $('#bolumFormEdit').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var bolumId = $('#bolumIdEdit').val();
        $.ajax({
            url: '/admin/bolumler/' + bolumId,
            type: "POST",
            data: formData,
            success: function(response) {
                toastr.success("Başarılı bir şekilde düzenlendi");
                $('#editBolumModal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr) {
                toastr.warning('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });

// Bölüm Silme
    $('.deleteBolumBtn').click(function() {
        var bolumId = $(this).data('id');

        if (confirm('Bu bölümü silmek istediğinize emin misiniz?')) {
            $.ajax({
                url: '/admin/bolumler/' + bolumId,
                type: "GET",
                success: function(response) {
                    toastr.success("Başarılı bir şekilde silindi");
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr) {
                    toastr.warning('Bir hata oluştu: ' + xhr.responseText);
                }
            });
        }
    });

    // Bölüm Düzenleme Modalı Açma
    $('.editBolumModalBtn').click(function() {
        var bolumId = $(this).data('id');

        // Ajax isteği yapılıyor
        $.ajax({
            url: '/admin/bolumler/' + bolumId + '/edit',
            type: 'GET',
            dataType: 'json', // Alınacak veri türü
            success: function(response) {
                // Başarılı olursa modal içeriğini doldur
                $('#bolumKoduEdit').val(response.bolum.bolumKodu);
                $('#bolumAdEdit').val(response.bolum.bolumAd);
                $('#birimIdEdit').val(response.bolum.birimId);
                $('#bolumIdEdit').val(bolumId);
                $('#editBolumModal').modal('show'); // Modalı göster
            },
            error: function(xhr, status, error) {
                // Hata durumunda bildirim göster
                toastr.warning('Bir hata oluştu. Lütfen tekrar deneyin.');
            }
        });
    });


// Bölüm Ekleme Modalı Açma
    $('#addBolumModalBtn').click(function() {
        $('#addBolumModal').modal('show');
    });

});

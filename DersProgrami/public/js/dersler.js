$(document).ready(function () {

    // Ders Ekleme
    $('#dersForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "/admin/dersler",
            type: "POST",
            data: formData,
            success: function(response) {
                $('#addDersModal').modal('hide');
                alert(response.success);
                location.reload(); // Sayfayı yenile
            },
            error: function(xhr) {
                alert('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });

    // Ders Düzenleme
    $('#dersFormEdit').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var dersId = $('#dersIdEdit').val();

        $.ajax({
            url: '/admin/dersler/' + dersId,
            type: "POST",
            data: formData,
            success: function(response) {
                $('#editDersModal').modal('hide');
                alert(response.success);
                location.reload(); // Sayfayı yenile
            },
            error: function(xhr) {
                alert('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });

    // Ders Silme
    $('.deleteDersBtn').click(function() {
        var dersId = $(this).data('id');

        if (confirm('Bu dersi silmek istediğinize emin misiniz?')) {
            $.ajax({
                url: '/admin/dersler/' + dersId,
                type: "GET",
                success: function(response) {
                    alert(response.success);
                    location.reload(); // Sayfayı yenile
                },
                error: function(xhr) {
                    alert('Bir hata oluştu: ' + xhr.responseText);
                }
            });
        }
    });

    // Ders Düzenleme Modalı Açma
    $('.editDersModalBtn').click(function() {
        var dersId = $(this).data('id');

        // Ders bilgilerini modal üzerinde göster
        $.ajax({
            url: '/admin/dersler/' + dersId + '/edit',
            type: 'GET',
            success: function(response) {
                $('#dersKoduEdit').val(response.ders.dersKodu);
                $('#dersAdiEdit').val(response.ders.dersAdi);
                $('#bolumIdEdit').val(response.ders.bolumId); // Bölüm seçimi
                $('#dersSaatiEdit').val(response.ders.dersSaati);
                $('#dersIdEdit').val(dersId);
                $('#editDersModal').modal('show');
            },
            error: function(xhr) {
                alert('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });


    // Ders Ekleme Modalı Açma
    $('#addDersModalBtn').click(function() {
        $('#addDersModal').modal('show');
    });

});

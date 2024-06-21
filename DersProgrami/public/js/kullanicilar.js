$(document).ready(function() {
    $(document).on('click', '.editUserModalBtn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '/admin/kullanicilar/duzenle/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Populate the form with user data
                $('#mailEdit').val(response.kullanici.mail);
                $('#adEdit').val(response.kullanici.ad);
                $('#soyadEdit').val(response.kullanici.soyad);
                $('#sifreEdit').val(response.kullanici.sifre);
                $('#bolumIdEdit').val(response.kullanici.bolumId);
                $('#unvanIdEdit').val(response.kullanici.unvanId);
                $('#yetkiIdEdit').val(response.kullanici.yetkiId);
                $('#userIdEdit').val(response.kullanici.id);

                $('#bolumIdEdit').empty();
                $.each(response.bolumler, function(key, value) {
                    $('#bolumIdEdit').append('<option value="' + value.bolumId + '">' + value.bolumAd + '</option>');
                });

                $('#unvanIdEdit').empty();
                $.each(response.unvanlar, function(key, value) {
                    $('#unvanIdEdit').append('<option value="' + value.unvanId + '">' + value.unvanAd + '</option>');
                });

                $('#yetkiIdEdit').empty();
                $.each(response.yetkiler, function(key, value) {
                    $('#yetkiIdEdit').append('<option value="' + value.yetkiId + '">' + value.yetkiAd + '</option>');
                });

                // Select the appropriate options
                $('#bolumIdEdit').val(response.kullanici.bolumId);
                $('#unvanIdEdit').val(response.kullanici.unvanId);
                $('#yetkiIdEdit').val(response.kullanici.yetkiId);

                // Show the modal
                $('#editUserModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error appropriately
            }
        });
    });

    $('#addUserModalBtn').on('click', function() {
        $.ajax({
            url: '/admin/kullanicilar/ekle',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Populate select options for adding a user
                $('#bolumId').empty();
                $.each(response.bolumler, function(key, value) {
                    $('#bolumId').append('<option value="' + value.bolumId + '">' + value.bolumAd + '</option>');
                });

                $('#unvanId').empty();
                $.each(response.unvanlar, function(key, value) {
                    $('#unvanId').append('<option value="' + value.unvanId + '">' + value.unvanAd + '</option>');
                });

                $('#yetkiId').empty();
                $.each(response.yetkiler, function(key, value) {
                    $('#yetkiId').append('<option value="' + value.yetkiId + '">' + value.yetkiAd + '</option>');
                });

                // Show the modal
                $('#addUserModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error appropriately
            }
        });
    });

    $('.deleteUserBtn').on('click', function() {
        var userId = $(this).data('id');
        if (confirm('Bu kullanıcıyı silmek istediğinizden emin misiniz?')) {
            $.ajax({
                url: '/admin/kullanicilar/sil/' + userId,
                type: 'GET',
                success: function(response) {
                    // Silme işlemi başarılı olduğunda sayfayı yeniden yükle
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(xhr.responseText); // Hata durumunda konsola yazdır
                }
            });
        }
    });

    $('#kullaniciFormEdit').submit(function(e) {
        e.preventDefault();
        var userId = $('#userIdEdit').val();
        var formData = $(this).serialize();

        $.ajax({
            url: '/admin/kullanicilar/duzenle/' + userId,
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editUserModal').modal('hide');
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#kullaniciForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/admin/kullanicilar/ekle',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Başarılı bir şekilde eklendiğinde modalı kapat
                $('#addUserModal').modal('hide');
                location.reload();
                // Bu kısmı, örneğin listedeki veriyi yeniden yükleyerek veya yeni satır ekleyerek yapabilirsiniz
            }
        });
    });
});

$(document).ready(function() {
    $(document).on('click', '.editBirimModalBtn', function() {
        var birimId = $(this).data('id');
        $.ajax({
            url: '/admin/birimler/' + birimId + '/edit',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Populate the form with birim data
                $('#birimKoduEdit').val(response.birim.birimKodu);
                $('#birimAdEdit').val(response.birim.birimAd);
                $('#birimIdEdit').val(response.birim.birimId);

                // Show the modal
                $('#editBirimModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Handle error appropriately
            }
        });
    });

    $('#addBirimModalBtn').on('click', function() {
        $('#addBirimModal').modal('show');
    });

    $('.deleteBirimBtn').on('click', function() {
        var birimId = $(this).data('id');
        if (confirm('Bu birimi silmek istediğinizden emin misiniz?')) {
            $.ajax({
                url: '/admin/birimler/' + birimId,
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

    $('#birimFormEdit').submit(function(e) {
        e.preventDefault();
        var birimId = $('#birimIdEdit').val();
        var formData = $(this).serialize();

        $.ajax({
            url: '/admin/birimler/' + birimId,
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editBirimModal').modal('hide');
                location.reload();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#birimForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/admin/birimler',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Başarılı bir şekilde eklendiğinde modalı kapat
                $('#addBirimModal').modal('hide');
                location.reload();
                // Bu kısmı, örneğin listedeki veriyi yeniden yükleyerek veya yeni satır ekleyerek yapabilirsiniz
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(xhr.responseText);
            }
        });
    });
});

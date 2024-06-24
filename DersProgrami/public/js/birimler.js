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
                toastr.warning(error);
                // Handle error appropriately
            }
        });
    });

    $('#addBirimModalBtn').on('click', function() {
        console.log("virim ekle utonu tıklnadı");
        $('#addBirimModal').modal('show');
    });

    $('.deleteBirimBtn').on('click', function() {
        var birimId = $(this).data('id');
        if (confirm('Bu birimi silmek istediğinizden emin misiniz?')) {
            $.ajax({
                url: '/admin/birimler/' + birimId,
                type: 'GET',
                success: function(response) {
                    toastr.success("Başarılı bir şekilde silindi");
                    // Silme işlemi başarılı olduğunda sayfayı yeniden yükle
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(xhr, textStatus, errorThrown) {
                    toastr.warning(xhr.responseText); // Hata durumunda konsola yazdır
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
                toastr.success("Başarılı bir şekilde düzenlendi");
                $('#editBirimModal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            },
            error: function(xhr, textStatus, errorThrown) {
                toastr.warning(xhr.responseText);
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
                toastr.success("Başarılı bir şekilde eklendi");
                // Başarılı bir şekilde eklendiğinde modalı kapat
                $('#addBirimModal').modal('hide');
                setTimeout(function() {
                    location.reload();
                }, 2000);
                // Bu kısmı, örneğin listedeki veriyi yeniden yükleyerek veya yeni satır ekleyerek yapabilirsiniz
            },
            error: function(xhr, textStatus, errorThrown) {
                toastr.warning(xhr.responseText);
            }
        });
    });
});

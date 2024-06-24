$(document).ready(function () {
    // Sınıf Ekleme
    $('#sinifForm').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: "/admin/siniflar",
            type: "POST",
            data: formData,
            success: function (response) {
                $('#addSinifModal').modal('hide');
                toastr.success(response.success);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            },
            error: function (xhr) {
                toastr.warning('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });

    // Sınıf Düzenleme
    $('#sinifFormEdit').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        var sinifId = $('#sinifIdEdit').val();

        $.ajax({
            url: '/admin/siniflar/' + sinifId,
            type: "POST",
            data: formData,
            success: function (response) {
                $('#editSinifModal').modal('hide');
                toastr.success(response.success);
                setTimeout(function () {
                    location.reload();
                }, 2000);
            },
            error: function (xhr) {
                toastr.warning('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });

    // Sınıf Silme
    $('.deleteSinifBtn').click(function () {
        var sinifId = $(this).data('id');

        if (confirm('Bu sınıfı silmek istediğinize emin misiniz?')) {
            $.ajax({
                url: '/admin/siniflar/' + sinifId,
                type: "GET",
                success: function (response) {
                    toastr.success(response.success);
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                },
                error: function (xhr) {
                    toastr.warning('Bir hata oluştu: ' + xhr.responseText);
                }
            });
        }
    });

    // Sınıf Düzenleme Modalı Açma
    $('.editSinifModalBtn').click(function () {
        var sinifId = $(this).data('id');

        // Sınıf bilgilerini modal üzerinde göster
        $.ajax({
            url: '/admin/siniflar/' + sinifId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#sinifAdEdit').val(response.sinif.sinifAd);
                $('#kapasiteEdit').val(response.sinif.kapasite);
                $('#sinifIdEdit').val(sinifId);
                $('#editSinifModal').modal('show');
            },
            error: function (xhr) {
                alert('Bir hata oluştu: ' + xhr.responseText);
            }
        });
    });


    // Sınıf Ekleme Modalı Açma
    $('#addSinifModalBtn').click(function () {
        $('#addSinifModal').modal('show');
    });
});

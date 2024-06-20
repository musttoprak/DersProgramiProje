$(document).ready(function() {
    // Kullanıcıyı düzenle butonuna tıklama olayı
    $('.editUserBtn').click(function() {
        var userId = $(this).data('id');
        $.ajax({
            url: '/admin/kullanicilar/duzenle/' + userId,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Modal içerisine verileri doldurma işlemi
                $('#mailEdit').val(response.mail);
                $('#adEdit').val(response.ad);
                $('#soyadEdit').val(response.soyad);
                $('#bolumIdEdit').val(response.bolumId);
                $('#unvanIdEdit').val(response.unvanId);
                $('#yetkiIdEdit').val(response.yetkiId);
                $('#userIdEdit').val(response.id); // Kullanıcı ID'sini saklayalım
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Hata durumunda kullanıcıya bildirim verebilirsiniz
            }
        });
    });

    // Kullanıcıyı düzenle formu submit olayı
    $('#kullaniciFormEdit').submit(function(e) {
        e.preventDefault();
        var userId = $('#userIdEdit').val();
        var formData = $(this).serialize();
        $.ajax({
            url: '/admin/kullanicilar/' + userId,
            type: 'PUT',
            data: formData,
            success: function(response) {
                // Başarılı bir şekilde güncellendiğinde modalı kapat
                $('#editUserModal').modal('hide');
                // Ekrandaki veriyi güncelle
                // Bu kısmı, örneğin listedeki veriyi yeniden yükleyerek veya güncel veriyle değiştirerek yapabilirsiniz
            }
        });
    });

    // Kullanıcıyı sil butonuna tıklama olayı
    $('.deleteUserBtn').click(function() {
        var userId = $(this).data('id');
        if (confirm('Kullanıcıyı silmek istediğinizden emin misiniz?')) {
            $.ajax({
                url: '/admin/kullanicilar/' + userId,
                type: 'DELETE',
                success: function(response) {
                    // Başarılı bir şekilde silindiğinde yapılacak işlemler
                    // Bu kısmı, örneğin tabloyu yeniden yükleyerek veya silinen satırı listeden kaldırarak yapabilirsiniz
                }
            });
        }
    });

    // Yeni kullanıcı ekle formu submit olayı
    $('#kullaniciForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: '/admin/kullanicilar',
            type: 'POST',
            data: formData,
            success: function(response) {
                // Başarılı bir şekilde eklendiğinde modalı kapat
                $('#addUserModal').modal('hide');
                // Ekrandaki veriyi güncelle
                // Bu kısmı, örneğin listedeki veriyi yeniden yükleyerek veya yeni satır ekleyerek yapabilirsiniz
            }
        });
    });
});

//$(document).ready(function() {

    // Sayfa yüklendiğinde kullanıcıları getir
    //getUsers();
    //var users;
    //// Kullanıcıları AJAX ile getiren fonksiyon
    //function getUsers() {
    //    $.ajax({
    //        url: '../../../includes/Admin.php',
    //        method: 'POST',
    //        data: { action: 'getUsers' },
    //        dataType: 'json',
    //        success: function(response) {
    //            if (response.success) {
    //                users = response.users;
    //                var html = '';
    //
    //                users.forEach(function(user) {
    //                    html += '<tr>';
    //                    html += '<td>' + user.mail + '</td>';
    //                    html += '<td>' + user.ad + '</td>';
    //                    html += '<td>' + user.soyad + '</td>';
    //                    html += '<td>' + user.bolumId + '</td>';
    //                    html += '<td>' + user.unvanId + '</td>';
    //                    html += '<td>' + user.yetkiId + '</td>';
    //                    html += '<td>' +
    //                        '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editUserModal" data-action="edit"  data-user-id="' + user.id + '">Düzenle</button> ' +
    //                        '<button type="button" class="btn btn-sm btn-danger deleteUserBtn"  data-user-id="' + user.id + '">Sil</button>' +
    //                        '</td>';
    //                    html += '</tr>';
    //                });
    //
    //                $('#userTableBody').html(html);
    //
    //
    //                // Silme butonu tıklanınca işlem yapılacak
    //                $('.deleteUserBtn').click(function(e) {
    //                    e.preventDefault();
    //                    var userId = $(this).data('user-id');
    //                    var confirmation = confirm('Kullanıcıyı silmek istediğinizden emin misiniz?');
    //                    if (confirmation) {
    //                        deleteUser(userId);
    //                    }
    //                });
    //            } else {
    //                alert('Kullanıcılar alınırken bir hata oluştu.');
    //            }
    //        },
    //        error: function() {
    //            alert('Kullanıcılar alınırken bir hata oluştu.');
    //        }
    //    });
    //}
    //
    //function deleteUser(userId) {
    //    $.ajax({
    //        url: '../../../includes/Admin.php',
    //        method: 'POST',
    //        data: {
    //            action: 'deleteUser',
    //            userId: userId
    //        },
    //        dataType: 'json',
    //        success: function(response) {
    //            if (response.success) {
    //                getUsers();
    //                alert(response.message);
    //            } else {
    //                alert(response.message);
    //            }
    //        },
    //        error: function() {
    //            alert('Kullanıcı silinirken bir hata oluştu.');
    //        }
    //    });
    //}

    //$('#editUserModal').on('show.bs.modal', function (event) {
   //     console.log("adsd");
   //     var button = $(event.relatedTarget);
   //     var userId = button.data('user-id');
   //     // userId ile eşleşen kullanıcıyı bul
   //     var selectedUser = users.find(function (user) {
   //         return user.id === userId;
   //     });
   //     console.log(selectedUser);
   //     $('#userIdEdit').val(selectedUser.id);
   //     $('#mailEdit').val(selectedUser.mail);
   //     $('#sifreEdit').val(selectedUser.sifre);
   //     $('#adEdit').val(selectedUser.ad);
   //     $('#soyadEdit').val(selectedUser.soyad);
   //     $('#bolumIdEdit').val(selectedUser.bolumId);
   //     $('#unvanIdEdit').val(selectedUser.unvanId);
   //     $('#yetkiIdEdit').val(selectedUser.yetkiId);
   // });
   //
   // $('#kullaniciForm').submit(function (event) {
   //     event.preventDefault(); // Formun default submit işlemini engelliyoruz.
   //
   //     var formData = $(this).serialize(); // Form verilerini alıyoruz.
   //
   //     $.ajax({
   //         type: 'POST',
   //         url: '../../../includes/Admin.php', // Admin.php dosyasını çağırıyoruz
   //         data: {
   //             action: 'addUser', // İşlemi belirtmek için bir action parametresi gönderiyoruz
   //             formData: formData // Form verilerini gönderiyoruz
   //         },
   //         dataType: 'json',
   //         success: function (response) {
   //             if (response.success) {
   //                 $('#kullaniciForm')[0].reset(); // Formu resetle
   //                 getUsers();
   //                 $('#addUserModal').modal('hide');
   //             } else {
   //                 alert(response.message); // Hata mesajı göster
   //             }
   //         },
   //         error: function (xhr, status, error) {
   //             alert('Bir hata oluştu: ' + error); // Ajax hatası
   //         }
   //     });
   // });
   //
   // $('#kullaniciFormEdit').submit(function (event) {
   //     event.preventDefault();
   //
   //     var formData = $(this).serialize();
   //
   //     $.ajax({
   //         type: 'POST',
   //         url: '../../../includes/Admin.php', // Admin.php dosyasını çağırıyoruz
   //         data: {
   //             action: 'editUser', // İşlemi belirtmek için bir action parametresi gönderiyoruz
   //             formData: formData // Form verilerini gönderiyoruz
   //         },
   //         dataType: 'json',
   //         success: function (response) {
   //             if (response.success) {
   //                 $('#kullaniciFormEdit')[0].reset(); // Formu resetle
   //                 getUsers();
   //                 $('#editUserModal').modal('hide');
   //             } else {
   //                 alert(response.message); // Hata mesajı göster
   //             }
   //         },
   //         error: function (xhr, status, error) {
   //             alert('Bir hata oluştu: ' + error); // Ajax hatası
   //         }
   //     });
   // });

    //fetchOptionsAdd();
    //fetchOptionsEdit();

   //function fetchOptionsAdd() {
   //    $.ajax({
   //        type: 'POST',
   //        url: '../../../includes/Admin.php', // Admin.php dosyasını çağırıyoruz
   //        data: {
   //            action: 'getOptions' // İşlemi belirtmek için bir action parametresi gönderiyoruz
   //        },
   //        dataType: 'json',
   //        success: function (response) {
   //            if (response.success) {
   //                // Bölüm seçeneklerini doldur
   //                var bolumOptions = response.bolumler.map(function(bolum) {
   //                    return `<option value="${bolum.bolumId}">${bolum.bolumAd}</option>`;
   //                });
   //                $('#bolumId').html(bolumOptions);
   //
   //                // Unvan seçeneklerini doldur
   //                var unvanOptions = response.unvanlar.map(function(unvan) {
   //                    return `<option value="${unvan.unvanId}">${unvan.unvanAd}</option>`;
   //                });
   //                $('#unvanId').html(unvanOptions);
   //
   //                // Yetki seçeneklerini doldur
   //                var yetkiOptions = response.yetkiler.map(function(yetki) {
   //                    return `<option value="${yetki.yetkiId}">${yetki.yetkiAd}</option>`;
   //                });
   //                $('#yetkiId').html(yetkiOptions);
   //            } else {
   //                alert('Seçenekler çekilirken bir hata oluştu.');
   //            }
   //        },
   //        error: function (xhr, status, error) {
   //            alert('Bir hata oluştu: ' + error); // Ajax hatası
   //        }
   //    });
   //}
   //function fetchOptionsEdit() {
   //    $.ajax({
   //        type: 'POST',
   //        url: '../../../includes/Admin.php', // Admin.php dosyasını çağırıyoruz
   //        data: {
   //            action: 'getOptions' // İşlemi belirtmek için bir action parametresi gönderiyoruz
   //        },
   //        dataType: 'json',
   //        success: function (response) {
   //            if (response.success) {
   //                // Bölüm seçeneklerini doldur
   //                var bolumOptions = response.bolumler.map(function(bolum) {
   //                    return `<option value="${bolum.bolumId}">${bolum.bolumAd}</option>`;
   //                });
   //                $('#bolumIdEdit').html(bolumOptions);
   //
   //                // Unvan seçeneklerini doldur
   //                var unvanOptions = response.unvanlar.map(function(unvan) {
   //                    return `<option value="${unvan.unvanId}">${unvan.unvanAd}</option>`;
   //                });
   //                $('#unvanIdEdit').html(unvanOptions);
   //
   //                // Yetki seçeneklerini doldur
   //                var yetkiOptions = response.yetkiler.map(function(yetki) {
   //                    return `<option value="${yetki.yetkiId}">${yetki.yetkiAd}</option>`;
   //                });
   //                $('#yetkiIdEdit').html(yetkiOptions);
   //            } else {
   //                alert('Seçenekler çekilirken bir hata oluştu.');
   //            }
   //        },
   //        error: function (xhr, status, error) {
   //            alert('Bir hata oluştu: ' + error); // Ajax hatası
   //        }
   //    });
   //}
//});

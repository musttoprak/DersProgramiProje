<?php
require_once(__DIR__ . '/../config/Db.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $admin = new Login();

    switch ($_POST['action']) {
        case 'login':
            parse_str($_POST['formData'], $formData);
            $mail = $formData['mail'];
            $sifre = $formData['sifre'];
            $user = $admin->login($mail,$sifre);
            if ($user !== false && count($user) == 1) {
                // Kullanıcı doğrulandıysa oturum başlat
                session_start();
                $_SESSION['kullanici_id'] = $user[0]['id'];
                $_SESSION['kullanici_mail'] = $user[0]['mail'];
                $_SESSION['kullanici_ad_soyad'] = $user[0]['ad'] .  $user[0]['soyad'];
                $_SESSION['kullanici_yetkiId'] = $user[0]['yetkiId'];

                echo json_encode(array(
                    'success' => true,
                    'message' => 'Giriş başarılı'
                ));
            } else {
                // Kullanıcı doğrulanamadıysa hata mesajı döndür
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Geçersiz kullanıcı adı veya şifre'
                ));
            }
            break;

        default:
            echo json_encode(array('success' => false, 'message' => 'Geçersiz işlem.'));
            break;
    }
}
class Login
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($mail, $sifre)
    {
        $query = "SELECT * FROM kullanicilar WHERE mail = :mail and sifre = :sifre";

        $params = array(
            'mail' => $mail,
            'sifre' => $sifre
        );

        return $this->db->query($query, $params);
    }

}

<?php
require_once(__DIR__ . '/../config/Db.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $admin = new Admin();

    switch ($_POST['action']) {
        case 'addUser':
            parse_str($_POST['formData'], $formData);
            $mail = $formData['mail'];
            $password = $formData['sifre'];
            $name = $formData['ad'];
            $surname = $formData['soyad'];
            $bolumId = intval($formData['bolumId']);
            $unvanId = intval($formData['unvanId']);
            $yetkiId = intval($formData['yetkiId']);

            $result = $admin->addUser($mail, $password, $name, $surname, $bolumId, $unvanId, $yetkiId);

            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Kullanıcı başarıyla eklendi.'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Kullanıcı eklenirken bir hata oluştu.'));
            }
            break;

        case 'editUser':
            parse_str($_POST['formData'], $formData);
            $userId = $formData['userIdEdit'];
            $mail = $formData['mailEdit'];
            $name = $formData['adEdit'];
            $surname = $formData['soyadEdit'];
            $bolumId = intval($formData['bolumIdEdit']);
            $unvanId = intval($formData['unvanIdEdit']);
            $yetkiId = intval($formData['yetkiIdEdit']);

            $result = $admin->editUser($userId, $mail, $name, $surname, $bolumId, $unvanId, $yetkiId);

            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Kullanıcı başarıyla güncellendi.'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Kullanıcı güncellenirken bir hata oluştu.'));
            }
            break;

        case 'deleteUser':
            $userId = intval($_POST['userId']);

            $result = $admin->deleteUser($userId);

            if ($result) {
                echo json_encode(array('success' => true, 'message' => 'Kullanıcı başarıyla silindi.'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Kullanıcı silinirken bir hata oluştu.'));
            }
            break;

        case 'getOptions':
            $bolumler = $admin->getBolumler();
            $unvanlar = $admin->getUnvanlar();
            $yetkiler = $admin->getYetkiler();

            if ($bolumler !== false && $unvanlar !== false && $yetkiler !== false) {
                echo json_encode(array(
                    'success' => true,
                    'bolumler' => $bolumler,
                    'unvanlar' => $unvanlar,
                    'yetkiler' => $yetkiler
                ));
            } else {
                echo json_encode(array('success' => false));
            }
            break;

        case 'getUsers':
            $users = $admin->getUsers();
            if ($users !== false) {
                echo json_encode(array(
                    'success' => true,
                    'users' => $users
                ));
            } else {
                echo json_encode(array('success' => false));
            }
            break;

        default:
            echo json_encode(array('success' => false, 'message' => 'Geçersiz işlem.'));
            break;
    }
}

class Admin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addUser($mail, $sifre, $ad, $soyad, $bolumId, $unvanId, $yetkiId)
    {
        $query = "INSERT INTO kullanicilar (mail, sifre, ad, soyad, bolumId, unvanId, yetkiId, olusturmaTarihi) 
              VALUES (:mail, :sifre, :ad, :soyad, :bolumId, :unvanId, :yetkiId, NOW())";

        $params = array(
            'mail' => $mail,
            'sifre' => $sifre,
            'ad' => $ad,
            'soyad' => $soyad,
            'bolumId' => $bolumId,
            'unvanId' => $unvanId,
            'yetkiId' => $yetkiId
        );

        return $this->db->query($query, $params);
    }

    public function editUser($userId, $mail, $ad, $soyad, $bolumId, $unvanId, $yetkiId)
    {
        $query = "UPDATE kullanicilar SET mail = :mail, ad = :ad, soyad = :soyad, bolumId = :bolumId, unvanId = :unvanId, yetkiId = :yetkiId WHERE id = :userId";

        $params = array(
            'userId' => $userId,
            'mail' => $mail,
            'ad' => $ad,
            'soyad' => $soyad,
            'bolumId' => $bolumId,
            'unvanId' => $unvanId,
            'yetkiId' => $yetkiId
        );

        return $this->db->query($query, $params);
    }

    public function deleteUser($userId)
    {
        $query = "DELETE FROM kullanicilar WHERE id = :userId";

        $params = array(
            'userId' => $userId
        );

        return $this->db->query($query, $params);
    }

    public function getUsers()
    {
        $query = "SELECT * FROM kullanicilar";
        return $this->db->selectAll($query);
    }

    public function getBolumler()
    {
        $query = "SELECT bolumId, bolumAd FROM bolumler";
        return $this->db->selectAll($query);
    }

    public function getUnvanlar()
    {
        $query = "SELECT unvanId, unvanAd FROM unvanlar";
        return $this->db->selectAll($query);
    }

    public function getYetkiler()
    {
        $query = "SELECT yetkiId, yetkiAd FROM yetkiler";
        return $this->db->selectAll($query);
    }

    // Diğer admin işlemleri için gerekli fonksiyonlar buraya eklenebilir
}

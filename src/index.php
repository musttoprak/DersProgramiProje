<?php
session_start();
$isim = "http://localhost/dersProgram/";

define("ANA_DIZIN", $isim);
define("TITLE", "EBYU Ders Programı");
define("RESIMLER", $isim . "assets/images/");
define("CSSLER", $isim . "assets/css/");
define("JSLER", $isim . "assets/js/");
define("TEMA", $isim . "assets/tema/AdminLTE-3.2.0/");

require_once 'fonksiyonlar.php';
require_once 'kontroller.php';
require_once 'veritabani/Db.class.php';
$FONK = new FONK();
$DB = new Db();

$kontroller = new Kontroller();

<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "ogrencikafasi";

// Create bağlantısı
$con = mysqli_connect($servername, $username, $password,$db);

// Kontrol bağlantısı
if (!$con) {
    die("Bağlantı başarısız: " . mysqli_connect_error());
}


?>

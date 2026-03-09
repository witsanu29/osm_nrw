<?php
$servername = "localhost";  // ปรับเป็น host ของคุณ
$username = "sa";         // ปรับ username
$password = "sa";             // ปรับ password
$dbname = "osm_nrw"; // ปรับชื่อฐานข้อมูล

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8"); // ตั้ง charset
?>

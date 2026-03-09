<?php
$hostname = "localhost";       // ? ใส่ชื่อ host หรือ IP จริง เช่น 127.0.0.1 หรือ db.yourdomain.com
$username = "sa";        // ? ชื่อผู้ใช้ฐานข้อมูล (จากโฮสต์จริง)
$password = "sa";    // ? รหัสผ่านฐานข้อมูล
$database = "osm_nrw";        // ? ชื่อฐานข้อมูลที่ใช้งาน

$conn = new mysqli($hostname, $username, $password, $database);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// กำหนด Charset สำหรับภาษาไทย
$conn->set_charset("utf8mb4");

?>

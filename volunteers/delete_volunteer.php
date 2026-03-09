<?php
session_start();
include 'includes/db_connect.php';

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('ไม่พบรหัสที่ต้องการลบ'); window.location.href='view_volunteers.php';</script>";
    exit;
}

$id = intval($_GET['id']);

// เตรียมคำสั่ง SQL แบบป้องกัน SQL Injection
$stmt = $conn->prepare("DELETE FROM volunteers WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว'); window.location.href='view_volunteers.php';</script>";
} else {
    echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล'); window.location.href='view_volunteers.php';</script>";
}
?>

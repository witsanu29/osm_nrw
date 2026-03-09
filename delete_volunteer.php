<?php
session_start();
include '../includes/db_connect.php'; // ต้องแน่ใจว่าไฟล์นี้เชื่อมต่อฐานข้อมูลได้สำเร็จ

// ตรวจสอบสิทธิ์ (สมมติ user info เก็บใน $_SESSION['user'])
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    $_SESSION['error'] = "ไม่มีสิทธิ์ลบข้อมูล";
    header('Location: view_volunteers.php');
    exit;
}

// ตรวจสอบว่ามี POST และมี id หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // เตรียมคำสั่งลบ
    $stmt = $conn->prepare("DELETE FROM volunteers WHERE id = ?");
    if (!$stmt) {
        $_SESSION['error'] = "Prepare statement ผิดพลาด: " . $conn->error;
        header('Location: view_volunteers.php');
        exit;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = "ลบข้อมูลเรียบร้อยแล้ว";
        } else {
            $_SESSION['error'] = "ไม่พบรหัสที่ต้องการลบ";
        }
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการลบ: " . $stmt->error;
    }

    $stmt->close();

} else {
    $_SESSION['error'] = "ไม่พบรหัสที่ต้องการลบ";
}

// กลับไปหน้าแสดงรายชื่อ
header('Location: view_volunteers.php');
exit;
?>

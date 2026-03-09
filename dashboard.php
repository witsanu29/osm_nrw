<!-- dashboard.php -->
<?php
session_start();
include 'users/session.php';
include 'includes/db_connect.php';

// ตรวจสอบว่าล็อกอินหรือยัง
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['user']['username'];
$role = $_SESSION['user']['role'];
?>


<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Dashboard - ระบบ อสม.</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background-color:#f8f9fa;
}

.card{
    border-radius:15px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

.btn{
    min-width:160px;
}
</style>

</head>
<body>

<div class="container py-5">

<div class="card p-4">

<h2 class="mb-4 text-primary">
ยินดีต้อนรับ <?= htmlspecialchars($username); ?>
<small class="text-muted">(<?= htmlspecialchars($role); ?>)</small>
</h2>


<div class="d-flex flex-wrap gap-2 mb-3">

<?php if($role == 'admin'): ?>

<a href="volunteers/add_volunteer.php" class="btn btn-success">
➕ เพิ่ม อสม.
</a>

<?php endif; ?>

<a href="volunteers/view_volunteers.php" class="btn btn-primary">
📋 ดูรายชื่อ อสม.
</a>

<?php if($role == 'admin'): ?>

<a href="export/export_excel.php" class="btn btn-warning text-dark">
📤 ส่งออก Excel
</a>

<?php endif; ?>

<a href="users/logout.php" class="btn btn-danger">
🚪 ออกจากระบบ
</a>

</div>

</div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
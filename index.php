<?php
// index.php - หน้าแรกของระบบ osm_nrw
session_start();
include 'includes/db_connect.php';

$annRes = $conn->query("SELECT message FROM announcements ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ระบบทะเบียน อสม. หนองระเวียง</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(to right,#fdfbfb,#ebedee);
    min-height:100vh;
}
</style>
</head>

<body>

<div class="alert alert-info text-center">
📢 <strong>ประกาศ:</strong> กรุณาตรวจสอบข้อมูล อสม. ของคุณให้ครบถ้วน หากพบข้อมูลผิด กรุณาแจ้งเจ้าหน้าที่
</div>

<div class="container py-4">

<h1 class="text-center mb-4">ระบบทะเบียน อสม. หนองระเวียง</h1>

<?php if (!isset($_SESSION['user'])): ?>

<div class="card mx-auto" style="max-width:400px;">
<div class="card-body text-center">

<h5 class="mb-3">เข้าสู่ระบบ</h5>

<a href="users/login.php" class="btn btn-primary">
เข้าสู่ระบบ
</a>

</div>
</div>

<?php else: ?>

<div class="alert alert-success text-center">
สวัสดีคุณ <strong><?= $_SESSION['user']['username'] ?></strong>
(สิทธิ์: <?= $_SESSION['user']['role'] ?>)
</div>

<div class="text-center">

<a href="dashboard.php" class="btn btn-success">
เข้าสู่ Dashboard
</a>

<a href="users/logout.php" class="btn btn-secondary">
ออกจากระบบ
</a>

</div>

<?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>
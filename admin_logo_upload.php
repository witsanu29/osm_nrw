<?php
// admin_logo_upload.php - หน้าอัปโหลดโลโก้ระบบ
session_start();
if ($_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['logo'])) {
    $target = 'logo.png';
    move_uploaded_file($_FILES['logo']['tmp_name'], $target);
    header("Location: admin_logo_upload.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>อัปโหลดโลโก้</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h3>อัปโหลดโลโก้ระบบ</h3>
  <?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">อัปโหลดโลโก้ใหม่เรียบร้อยแล้ว</div>
  <?php endif; ?>
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="logo" class="form-control mb-3" accept="image/*" required>
    <button class="btn btn-primary">อัปโหลด</button>
  </form>
  <hr>
  <img src="logo.png" alt="โลโก้ปัจจุบัน" style="max-width:200px;">
</body>
</html>
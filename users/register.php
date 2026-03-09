<?php
// register.php - ฟอร์มสมัครสมาชิกระบบ อสม.
session_start();
include '../includes/db_connect.php';;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $created_at = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO users (username, password, role, created_at) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $password, $role, $created_at);

    if ($stmt->execute()) {
        header("Location: ../index.php?register=success");
        exit;
    } else {
        $error = "เกิดข้อผิดพลาดในการสมัครสมาชิก";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>สมัครสมาชิก</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
  <h3>สมัครสมาชิกใหม่</h3>
  <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
  <form method="post">
    <div class="mb-3">
      <label>ชื่อผู้ใช้</label>
      <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>รหัสผ่าน</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>สิทธิ์การใช้งาน</label>
      <select name="role" class="form-control" required>
        <option value="user">user</option>
        <option value="admin">admin</option>
      </select>
    </div>
    <button class="btn btn-primary">สมัครสมาชิก</button>
    <a href="index.php" class="btn btn-secondary">ย้อนกลับ</a>
  </form>
</body>
</html>
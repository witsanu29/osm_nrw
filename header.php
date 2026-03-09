<?php
session_start();

// ตัวอย่าง: กำหนด session user เอง (ถ้ายังไม่ login)
// $_SESSION['user'] = ['username' => 'witsanu'];

$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? $_SESSION['user']['username'] : '';
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <title>ระบบ Hard</title>
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="#">ระบบ Hard</a>
    <div class="d-flex ms-auto">
      <?php if ($isLoggedIn): ?>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle text-white" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            สวัสดี, <?= htmlspecialchars($username) ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="../users/logout.php">Logout</a></li>
          </ul>
        </div>
      <?php else: ?>
        <a href="../users/login.php" class="btn btn-light">Login</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <!-- เนื้อหาอื่น ๆ ของหน้า -->
  <h1>ยินดีต้อนรับเข้าสู่ระบบ Hard</h1>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

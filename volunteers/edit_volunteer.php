<?php
session_start();
include '../includes/db_connect.php';

if (!isset($_GET['id'])) {
    echo "ไม่พบรหัสผู้ใช้งาน";
    exit;
}

$id = intval($_GET['id']);

// ดึงข้อมูลเดิมจากฐานข้อมูล
$stmt = $conn->prepare("SELECT * FROM volunteers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "ไม่พบข้อมูล อสม. ที่ต้องการแก้ไข";
    exit;
}

$volunteer = $result->fetch_assoc();

// ถ้ามีการส่งฟอร์มเพื่อแก้ไขข้อมูล
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['keyword'])) {
        $_POST['keyword'] = "";
    }

    $stmtUpdate = $conn->prepare("UPDATE volunteers SET 
        card_no=?, cid=?, fullname=?, birthdate=?, house_no=?, village_no=?, subdistrict=?, district=?, province=?,
        year_start=?, blood_group=?, occupation=?, education_level=?, marital_status=?, unit_name=?, keyword=?
        WHERE id=?");

if (!$stmtUpdate) {
    die("Prepare failed: " . $conn->error);
}

$stmtUpdate->bind_param("ssssssssssssssssi",
    $_POST['card_no'],
    $_POST['cid'],
    $_POST['fullname'],
    $_POST['birthdate'],
    $_POST['house_no'],
    $_POST['village_no'],
    $_POST['subdistrict'],
    $_POST['district'],
    $_POST['province'],
    $_POST['year_start'],
    $_POST['blood_group'],
    $_POST['occupation'],
    $_POST['education_level'],
    $_POST['marital_status'],
    $_POST['unit_name'],
    $_POST['keyword'],
    $id
);


    if ($stmtUpdate->execute()) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย'); window.location.href='view_volunteers.php';</script>";
        exit;
    } else {
        echo "เกิดข้อผิดพลาดในการแก้ไขข้อมูล: " . $stmtUpdate->error;
    }
}

?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <title>แก้ไขข้อมูล อสม.</title>
    
  <?php include '../header.php'; ?>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

</head>
<body>

<div class="container mt-4">
  <h3>แก้ไขข้อมูล อสม.</h3>

  <form method="POST" action="">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">เลขที่บัตร อสม.</label>
        <input type="text" name="card_no" class="form-control" required value="<?= htmlspecialchars($volunteer['card_no']) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">เลขบัตรประชาชน</label>
        <input type="text" name="cid" class="form-control" required maxlength="13" value="<?= htmlspecialchars($volunteer['cid']) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">ชื่อ - สกุล</label>
        <input type="text" name="fullname" class="form-control" required value="<?= htmlspecialchars($volunteer['fullname']) ?>">
      </div>

      <div class="col-md-4">
        <label class="form-label">วันเกิด</label>
        <input type="date" name="birthdate" class="form-control" required value="<?= htmlspecialchars($volunteer['birthdate']) ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label">บ้านเลขที่</label>
        <input type="text" name="house_no" class="form-control" value="<?= htmlspecialchars($volunteer['house_no']) ?>">
      </div>
      <div class="col-md-2">
        <label class="form-label">หมู่ที่</label>
        <input type="text" name="village_no" class="form-control" value="<?= htmlspecialchars($volunteer['village_no']) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">ตำบล</label>
        <input type="text" name="subdistrict" class="form-control" value="<?= htmlspecialchars($volunteer['subdistrict']) ?>">
      </div>

      <div class="col-md-4">
        <label class="form-label">อำเภอ</label>
        <input type="text" name="district" class="form-control" value="<?= htmlspecialchars($volunteer['district']) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">จังหวัด</label>
        <input type="text" name="province" class="form-control" value="<?= htmlspecialchars($volunteer['province']) ?>">
      </div>

      <div class="col-md-3">
        <label class="form-label">ปีที่เริ่มเป็น อสม.</label>
        <input type="text" name="year_start" class="form-control" placeholder="พ.ศ. เช่น 2555" value="<?= htmlspecialchars($volunteer['year_start']) ?>">
      </div>
      <div class="col-md-3">
        <label class="form-label">กรุ๊ปเลือด</label>
        <input type="text" name="blood_group" class="form-control" placeholder="A, B, AB, O" value="<?= htmlspecialchars($volunteer['blood_group']) ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label">อาชีพ</label>
        <input type="text" name="occupation" class="form-control" value="<?= htmlspecialchars($volunteer['occupation']) ?>">
      </div>

      <div class="col-md-4">
        <label class="form-label">ระดับการศึกษา</label>
        <input type="text" name="education_level" class="form-control" placeholder="ประถม / ม.ต้น / ป.ตรี ฯลฯ" value="<?= htmlspecialchars($volunteer['education_level']) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">สถานภาพ</label>
        <input type="text" name="marital_status" class="form-control" placeholder="โสด / สมรส / หย่า ฯลฯ" value="<?= htmlspecialchars($volunteer['marital_status']) ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">หน่วยบริการ</label>
        <input type="text" name="unit_name" class="form-control" placeholder="รพ.พิมาย / หนองระเวียง ฯลฯ" value="<?= htmlspecialchars($volunteer['unit_name']) ?>">
      </div>
	  
<div class="col-md-12">
  <label class="form-label">คำค้นหา (keyword)</label>
  <input type="text" name="keyword" class="form-control" value="<?= htmlspecialchars($volunteer['keyword']) ?>">
</div>

<div class="text-end mt-4">
  <a href="view_volunteers.php" class="btn btn-secondary me-2">ย้อนกลับ</a>
  <button type="submit" class="btn btn-success">💾 บันทึกข้อมูล</button>
</div>

  </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

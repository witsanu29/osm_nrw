<?php
session_start();
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare("INSERT INTO volunteers 
        (card_no, cid, fullname, birthdate, house_no, village_no, subdistrict, district, province, year_start, blood_group, occupation, education_level, marital_status, unit_name, keyword) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssss",
        $_POST['card_no'], 
        $_POST['cid'], 
        $_POST['fullname'], 
        $_POST['birthdate'],
        $_POST['house_no'], 
        $_POST['village_no'], 
        $_POST['subdistrict'],
        $_POST['district'],       // เพิ่ม
        $_POST['province'],       // เพิ่ม
        $_POST['year_start'], 
        $_POST['blood_group'], 
        $_POST['occupation'], 
        $_POST['education_level'],
        $_POST['marital_status'], 
        $_POST['unit_name'], 
        $_POST['keyword']         // เพิ่ม
    );

    $stmt->execute();

    echo "<script>alert('เพิ่มข้อมูลเรียบร้อย'); location.href='view_volunteers.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>ลงทะเบียน อสม.</title>
  
    <?php include '../header.php'; ?>
	
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f0f2f5;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }
    .form-label {
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <div class="card p-4">
    <h3 class="text-primary mb-4">📋 ลงทะเบียน อสม.</h3>

    <form method="POST" action="add_volunteer.php">
      <div class="row g-3">
        <!-- แถว 1 -->
        <div class="col-md-4">
          <label class="form-label">เลขที่บัตร อสม.</label>
          <input type="text" name="card_no" class="form-control" required>
        </div>
        <div class="col-md-4">
          <label class="form-label">เลขบัตรประชาชน</label>
          <input type="text" name="cid" class="form-control" required maxlength="13">
        </div>
        <div class="col-md-4">
          <label class="form-label">ชื่อ - สกุล</label>
          <input type="text" name="fullname" class="form-control" required>
        </div>

        <!-- แถว 2 -->
        <div class="col-md-4">
          <label class="form-label">วันเกิด</label>
          <input type="date" name="birthdate" class="form-control" required>
        </div>
        <div class="col-md-2">
          <label class="form-label">บ้านเลขที่</label>
          <input type="text" name="house_no" class="form-control">
        </div>
        <div class="col-md-2">
          <label class="form-label">หมู่ที่</label>
          <input type="text" name="village_no" class="form-control">
        </div>
        <div class="col-md-4">
          <label class="form-label">ตำบล</label>
          <input type="text" name="subdistrict" class="form-control">
        </div>

		<!-- แถว 2 เพิ่ม district กับ province -->
		<div class="col-md-4">
			<label class="form-label">อำเภอ</label>
			<input type="text" name="district" class="form-control" placeholder="อำเภอ">
		</div>
		
		<div class="col-md-4">
		<label class="form-label">จังหวัด</label>
		<input type="text" name="province" class="form-control" placeholder="จังหวัด">
		</div>

        <!-- แถว 3 -->
        <div class="col-md-3">
          <label class="form-label">ปีที่เริ่มเป็น อสม.</label>
          <input type="text" name="year_start" class="form-control" placeholder="พ.ศ. เช่น 2555">
        </div>
        <div class="col-md-3">
          <label class="form-label">กรุ๊ปเลือด</label>
          <input type="text" name="blood_group" class="form-control" placeholder="A, B, AB, O">
        </div>
        <div class="col-md-6">
          <label class="form-label">อาชีพ</label>
          <input type="text" name="occupation" class="form-control">
        </div>

        <!-- แถว 4 -->
        <div class="col-md-4">
          <label class="form-label">ระดับการศึกษา</label>
          <input type="text" name="education_level" class="form-control" placeholder="ประถม / ม.ต้น / ป.ตรี ฯลฯ">
        </div>
        <div class="col-md-4">
          <label class="form-label">สถานภาพ</label>
          <input type="text" name="marital_status" class="form-control" placeholder="โสด / สมรส / หย่า ฯลฯ">
        </div>
        <div class="col-md-4">
          <label class="form-label">หน่วยบริการ</label>
          <input type="text" name="unit_name" class="form-control" placeholder="รพ.พิมาย / หนองระเวียง ฯลฯ">
        </div>
      </div>

		<div class="text-end mt-4">
			<a href="view_volunteers.php" class="btn btn-primary me-2">
			📋 ดูรายชื่อ
		</a>
		<button type="submit" class="btn btn-success px-4">
			💾 บันทึกข้อมูล
		</button>
		</div>

    </form>
  </div>
</div>

</body>
</html>

<?php
include '../includes/db_connect.php';

// รับค่าจาก GET แบบปลอดภัย
$keyword = $_GET['keyword'] ?? '';
$subdistrict = $_GET['subdistrict'] ?? '';
$district = $_GET['district'] ?? '';
$province = $_GET['province'] ?? '';

// สร้าง SQL แบบกรอง fullname หรือ cid ด้วย keyword และกรอง subdistrict, district, province
$sql = "SELECT * FROM volunteers 
        WHERE (fullname LIKE ? OR cid LIKE ?) 
        AND subdistrict LIKE ? 
        AND district LIKE ? 
        AND province LIKE ?
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);

// เตรียมค่าที่จะส่งเข้า SQL แบบมี % เพื่อ LIKE
$likeKeyword = "%$keyword%";
$likeSubdistrict = "%$subdistrict%";
$likeDistrict = "%$district%";
$likeProvince = "%$province%";

// bind_param เรียงลำดับตาม ? ใน SQL: 5 ตัว เป็น string ทั้งหมด
$stmt->bind_param("sssss", $likeKeyword, $likeKeyword, $likeSubdistrict, $likeDistrict, $likeProvince);

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8" />
  <title>รายชื่อ อสม. (ค้นหา)</title>
  
  <?php include '../header.php'; ?>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success">
      <?= htmlspecialchars($_SESSION['success']) ?>
    </div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger">
      <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>
  
  
<div class="container-fluid mt-4">
  <h3>🔍 ค้นหาและแสดงรายชื่อ อสม.</h3>

  <!-- ฟอร์มค้นหา -->
  <form method="get" class="row g-3 mb-4">
    <div class="col-md-3">
      <input type="text" name="keyword" class="form-control" placeholder="ชื่อ / เลขบัตรประชาชน" value="<?= htmlspecialchars($keyword) ?>">
    </div>
    <div class="col-md-3">
      <input type="text" name="subdistrict" class="form-control" placeholder="ตำบล" value="<?= htmlspecialchars($subdistrict) ?>">
    </div>
    <div class="col-md-3">
      <input type="text" name="district" class="form-control" placeholder="อำเภอ" value="<?= htmlspecialchars($district) ?>">
    </div>
    <div class="col-md-3">
      <input type="text" name="province" class="form-control" placeholder="จังหวัด" value="<?= htmlspecialchars($province) ?>">
    </div>
	
	<div class="col-12 text-end">
		<button type="submit" class="btn btn-primary me-2">ค้นหา</button>
		<a href="../index.php" class="btn btn-secondary">กลับหน้าหลัก</a>
	</div>

  </form>

  <!-- ตารางแสดงผล -->
<?php if ($result->num_rows > 0): ?>
<table class="table table-striped table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ลำดับ</th>
      <th>ชื่อ - สกุล</th>
      <th>เลขบัตรประชาชน</th>
      <th>ตำบล</th>
      <th>อำเภอ</th>
      <th>จังหวัด</th>
      <th>หน่วยบริการ</th>
      <th>จัดการ</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $no = 1;
    while ($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?= $no++; ?></td>
      <td><?= htmlspecialchars($row['fullname']) ?></td>
      <td><?= htmlspecialchars($row['cid']) ?></td>
      <td><?= htmlspecialchars($row['subdistrict']) ?></td>
      <td><?= htmlspecialchars($row['district']) ?></td>
      <td><?= htmlspecialchars($row['province']) ?></td>
      <td><?= htmlspecialchars($row['unit_name']) ?></td>
      <td>
        <a href="edit_volunteer.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
		
<form method="POST" action="delete_volunteer.php" onsubmit="return confirm('ยืนยันการลบข้อมูลนี้หรือไม่?');" style="display:inline;">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <button type="submit" class="btn btn-danger btn-sm">🗑️ ลบ</button>
</form>


      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>



<?php else: ?>
  <div class="alert alert-warning">ไม่พบข้อมูลที่ค้นหา</div>
<?php endif; ?>

	</div>
	
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function () {
      if (confirm('คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?')) {
        const id = this.getAttribute('data-id');
        fetch('delete_volunteer.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'id=' + encodeURIComponent(id)
        })
        .then(res => res.json())
        .then(data => {
          alert(data.message);
          if (data.status === 'success') {
            location.reload();
          }
        })
        .catch(err => {
          alert('เกิดข้อผิดพลาด: ' + err);
        });
      }
    });
  });
});

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

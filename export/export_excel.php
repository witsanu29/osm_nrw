<!-- export_excel.php -->
<?php
include '../includes/db_connect.php';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=volunteers.xls");
$result = $conn->query("SELECT * FROM volunteers");
echo "<table border='1'>";
echo "<tr><th>ชื่อ-สกุล</th><th>เลขบัตร</th><th>หน่วยบริการ</th></tr>";

// ปรับ export_excel.php/export_pdf.php ให้รวมเขตพื้นที่:
while ($r = $result->fetch_assoc()) {
  $area = $r['subdistrict'] . ' อ.' . $r['district'] . ' จ.' . $r['province'];
  echo "<tr><td>{$r['fullname']}</td><td>{$r['cid']}</td><td>{$r['unit_name']}</td><td>{$area}</td></tr>";
}

echo "</table>";
?>
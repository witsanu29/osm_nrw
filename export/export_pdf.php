<?php
// export_pdf.php
require('fpdf/fpdf.php');
include 'includes/db_connect.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'รายชื่อ อสม.',0,1,'C');
$pdf->SetFont('Arial','',12);

$result = $conn->query("SELECT fullname, cid, unit_name FROM volunteers");

// ปรับ export_excel.php/export_pdf.php ให้รวมเขตพื้นที่:
while ($r = $result->fetch_assoc()) {
  $area = $r['subdistrict'] . ' อ.' . $r['district'] . ' จ.' . $r['province'];
  echo "<tr><td>{$r['fullname']}</td><td>{$r['cid']}</td><td>{$r['unit_name']}</td><td>{$area}</td></tr>";
}

$pdf->Output();
?>
<!-- dashboard_stats.php -->
<?php
include 'includes/db_connect.php';
$data = $conn->query("SELECT unit_name, COUNT(*) AS total FROM volunteers GROUP BY unit_name");
$labels = [];
$values = [];
while ($row = $data->fetch_assoc()) {
    $labels[] = $row['unit_name'];
    $values[] = $row['total'];
}
?>
<canvas id="volChart" height="100"></canvas>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('volChart'), {
  type: 'bar',
  data: {
    labels: <?= json_encode($labels) ?>,
    datasets: [{
      label: 'จำนวน อสม. ต่อหน่วยบริการ',
      data: <?= json_encode($values) ?>,
      backgroundColor: 'rgba(54, 162, 235, 0.7)'
    }]
  }
});
</script>

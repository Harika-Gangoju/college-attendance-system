<?php
$conn = new mysqli("localhost", "root", "", "attendance_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = $_GET['id'];
$today = date("Y-m-d");

/* TODAY STATUS */
$todayQuery = $conn->query("
    SELECT status 
    FROM attendance 
    WHERE student_id='$student_id' 
    AND attendance_date='$today'
");

$todayStatus = ($todayQuery->num_rows > 0) 
               ? $todayQuery->fetch_assoc()['status'] 
               : "Not Marked Yet";

/* MONTHLY CALCULATION */
$totalQuery = $conn->query("
    SELECT COUNT(*) as total 
    FROM attendance 
    WHERE student_id='$student_id'
    AND MONTH(attendance_date)=MONTH(CURRENT_DATE())
");

$total = $totalQuery->fetch_assoc()['total'];

$presentQuery = $conn->query("
    SELECT COUNT(*) as present 
    FROM attendance 
    WHERE student_id='$student_id' 
    AND status='Present'
    AND MONTH(attendance_date)=MONTH(CURRENT_DATE())
");

$present = $presentQuery->fetch_assoc()['present'];


$percentage = ($total > 0) ? round(($present/$total)*100,2) : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Attendance</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2 class="mb-4">Attendance Report</h2>

<div class="card p-4 shadow">

<h4>📅 Today Status:</h4>
<p><strong><?= $todayStatus ?></strong></p>

<hr>

<h4>📊 Monthly Attendance:</h4>
<p>Total Classes: <?= $total ?></p>
<p>Present: <?= $present ?></p>
<p>Attendance Percentage: <?= $percentage ?>%</p>

</div>

</body>
</html>
<?php
include("db.php");

$date = date("Y-m-d");

// Total Students
$total_query = mysqli_query($conn, "SELECT * FROM students");
$total = mysqli_num_rows($total_query);

// Present Students
$present_query = mysqli_query($conn,
"SELECT * FROM attendance 
WHERE attendance_date='$date' 
AND status='Present'");
$present = mysqli_num_rows($present_query);

// Absent Students
$absent = $total - $present;

// Percentage
if($total > 0){
    $percentage = ($present / $total) * 100;
} else {
    $percentage = 0;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Attendance Summary</title>
</head>
<body>
 <style>
body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background:#f1f4f9;
}

.header{
    background:#1e3a8a;
    color:white;
    padding:20px;
    text-align:center;
    font-size:22px;
    font-weight:bold;
}

.container{
    width:90%;
    margin:40px auto;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
}

.card{
    width:22%;
    background:white;
    padding:25px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
    text-align:center;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h3{
    margin:10px 0;
    font-size:18px;
    color:#555;
}

.card p{
    font-size:28px;
    font-weight:bold;
}

.total{ border-top:5px solid #6366f1; }
.present{ border-top:5px solid #16a34a; }
.absent{ border-top:5px solid #dc2626; }
.percent{ border-top:5px solid #f59e0b; }

.btn{
    display:block;
    width:200px;
    margin:40px auto;
    text-align:center;
    padding:12px;
    background:#1e3a8a;
    color:white;
    text-decoration:none;
    border-radius:8px;
}

.btn:hover{
    background:#162c6a;
}
</style>

<div class="header">
    Attendance Summary - <?php echo $date; ?>
</div>

<div class="container">

    <div class="card total">
        <h3>Total Students</h3>
        <p><?php echo $total; ?></p>
    </div>

    <div class="card present">
        <h3>Present</h3>
        <p><?php echo $present; ?></p>
    </div>

    <div class="card absent">
        <h3>Absent</h3>
        <p><?php echo $absent; ?></p>
    </div>

    <div class="card percent">
        <h3>Attendance %</h3>
        <p><?php echo round($percentage,2); ?>%</p>
    </div>

</div>

<a href="dashboard.php" class="btn">Back to Dashboard</a>


</body>
</html>
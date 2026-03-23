<?php
session_start();
include "db.php";

if(!isset($_SESSION['teacher'])){
    header("Location: login.php");
    exit();
}

$today = date("Y-m-d");

// Total Students
$total_students = $conn->query("SELECT COUNT(*) as total FROM students")
                       ->fetch_assoc()['total'];

// Present Today
$present_today = $conn->query("SELECT COUNT(*) as present 
                               FROM attendance 
                                WHERE attendance_date='$today'
                               AND status='Present'")
                               ->fetch_assoc()['present'];

// Absent Today
$absent_today = $total_students - $present_today;

// Attendance Percentage Today
$percentage = 0;
if($total_students > 0){
    $percentage = ($present_today / $total_students) * 100;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Dashboard</title>
    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg,#4e73df,#1cc88a);
        }

        .header{
            background:#2e59d9;
            color:white;
            padding:15px;
            text-align:center;
            font-size:20px;
            font-weight:bold;
        }

        .container{
            width:90%;
            max-width:1100px;
            margin:30px auto;
        }

        .cards{
            display:flex;
            justify-content:space-between;
            flex-wrap:wrap;
            gap:20px;
        }

        .card{
            flex:1;
            min-width:200px;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
            text-align:center;
        }

        .card h3{
            margin:10px 0;
            color:#4e73df;
        }

        .percentage{
            font-size:22px;
            font-weight:bold;
            color:#1cc88a;
        }

        .actions{
            margin-top:30px;
            text-align:center;
        }

        .actions a{
            text-decoration:none;
            padding:12px 20px;
            margin:10px;
            background:#4e73df;
            color:white;
            border-radius:5px;
            display:inline-block;
        }

        .actions a:hover{
            background:#2e59d9;
        }

        .footer{
            margin-top:40px;
            text-align:center;
            color:white;
            font-size:14px;
        }
    </style>
</head>

<body>

<div class="header">
    Online Attendance Tracking - Teacher Dashboard
</div>

<div class="container">

    <h2 style="color:white;">Welcome, <?php echo $_SESSION['teacher']; ?> 👩‍🏫</h2>
    <p style="color:white;">Date: <?php echo $today; ?></p>

    <div class="cards">

        <div class="card">
            <h3>Total Students</h3>
            <p style="font-size:24px;"><?php echo $total_students; ?></p>
        </div>

        <div class="card">
            <h3>Present Today</h3>
            <p style="font-size:24px;"><?php echo $present_today; ?></p>
        </div>

        <div class="card">
            <h3>Absent Today</h3>
            <p style="font-size:24px;"><?php echo $absent_today; ?></p>
        </div>

        <div class="card">
            <h3>Today's Attendance %</h3>
            <p class="percentage"><?php echo round($percentage,2); ?>%</p>
        </div>

    </div>

    <div class="actions">
        <a href="mark_attendance.php">📝 Mark Attendance</a>
        <a href="attendance_history.php">Attendance History</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<div class="footer">
    Developed for Online Attendance Tracking Project
</div>

</body>
</html>
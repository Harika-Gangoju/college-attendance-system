<?php
session_start();
include("db.php");

   
if(!isset($_SESSION['student'])){
    header("Location: student_login.php");
    exit();
}

$student_name = $_SESSION['student'];



// Get student name
$student_name = $_SESSION['student'];

// Fetch attendance summary
$total = 0;
$present = 0;
$absent = 0;
$result = mysqli_query($conn, "SELECT status FROM attendance WHERE student_id='$student_name'");

while($row = mysqli_fetch_assoc($result)){
    $total++;
    if($row['status'] == "Present"){
        $present++;
    } else {
        $absent++;
    }
}

$percentage = $total > 0 ? round(($present/$total)*100) : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Portal</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin:0;
        }

        .navbar{
            background: #2c3e50;
            color:white;
            padding:15px;
            display:flex;
            justify-content: space-between;
        }

        .container{
            padding:20px;
        }

        .cards{
            display:flex;
            gap:20px;
            margin-top:20px;
        }

        .card{
            flex:1;
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 4px 10px rgba(0,0,0,0.1);
            text-align:center;
        }

        .card h2{
            margin:0;
            font-size:28px;
        }

        .present{ color:green; }
        .absent{ color:red; }
        .percentage{ color:blue; }

        table{
            width:100%;
            margin-top:30px;
            border-collapse: collapse;
            background:white;
        }

        th, td{
            padding:10px;
            border:1px solid #ddd;
            text-align:center;
        }

        th{
            background:#2c3e50;
            color:white;
        }

        .logout{
            color:white;
            text-decoration:none;
        }
    </style>
</head>

<body>

<div class="navbar">
    <h2>🎓 Student Portal</h2>
    <div>
        Welcome, <?php echo $student_name; ?> |
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>

<div class="container">

    <h3>Attendance Summary</h3>

    <div class="cards">
        <div class="card">
            <h2><?php echo $total; ?></h2>
            <p>Total Classes</p>
        </div>

        <div class="card">
            <h2 class="present"><?php echo $present; ?></h2>
            <p>Present</p>
        </div>

        <div class="card">
            <h2 class="absent"><?php echo $absent; ?></h2>
            <p>Absent</p>
        </div>

        <div class="card">
            <h2 class="percentage"><?php echo $percentage; ?>%</h2>
            <p>Attendance %</p>
        </div>
    </div>

    <h3>Attendance History</h3>

    <table>
        <tr>
            <th>Date</th>
            <th>Status</th>
        </tr>

        <?php

$history = mysqli_query($conn, "SELECT attendance_date, status FROM attendance 
WHERE student_id='$student_name' ORDER BY attendance_date DESC");

        while($row = mysqli_fetch_assoc($history)){
            $color = $row['status']=="Present" ? "green" : "red";
            echo "<tr>
                    <td>".$row['attendance_date']."</td>
                    <td style='color:$color;'>".$row['status']."</td>
                  </tr>";
        }
        ?>

    </table>

</div>

</body>
</html>
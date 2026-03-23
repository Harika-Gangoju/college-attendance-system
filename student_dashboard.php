<?php
session_start();
include("db.php");

if(!isset($_SESSION['student_id'])){
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$name_query = mysqli_query($conn, "SELECT name FROM students WHERE id='$student_id'");

if($name_query && mysqli_num_rows($name_query) > 0){
    $name_data = mysqli_fetch_assoc($name_query);
    $student_name = $name_data['name'];
} else {
    $student_name = "Student";
}




/* Total Classes */
$total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM attendance WHERE student_id='$student_id'");
$total = mysqli_fetch_assoc($total_query)['total'];

/* Present Count */
$present_query = mysqli_query($conn, "SELECT COUNT(*) as present FROM attendance 
WHERE student_id='$student_id' AND status='Present'");
$present = mysqli_fetch_assoc($present_query)['present'];

$percentage = $total > 0 ? round(($present/$total)*100,2) : 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>
<style>
body{
    font-family: Arial;
    background: linear-gradient(to right, #4e73df, #1cc88a);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    background:white;
    padding:30px;
    border-radius:15px;
    width:350px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h2{
    color:#4e73df;
}

.progress{
    background:#eee;
    border-radius:20px;
    overflow:hidden;
    margin:15px 0;
}

.progress-bar{
    height:20px;
    background:#1cc88a;
    width: <?php echo $percentage; ?>%;
}

.logout{
    display:inline-block;
    padding:10px 20px;
    background:#e74a3b;
    color:white;
    text-decoration:none;
    border-radius:20px;
}
</style>
</head>
<body>

<div class="card">
    <h2>Welcome <?php echo $student_name; ?></h2>
    <p><strong>Total Classes:</strong> <?php echo $total; ?></p>
    <p><strong>Present:</strong> <?php echo $present; ?></p>
    <p><strong>Attendance:</strong> <?php echo $percentage; ?>%</p>

    <div class="progress">
        <div class="progress-bar"></div>
    </div>

    <a href="logout.php" class="logout">Logout</a>
</div>

</body>
</html>
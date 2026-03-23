<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db.php");

// TOTAL STUDENTS
$result1 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM students");
$row1 = mysqli_fetch_assoc($result1);
$total_students = $row1['total'] ?? 0;

// TOTAL ATTENDANCE
$result2 = mysqli_query($conn, "SELECT COUNT(*) AS total FROM attendance");
$row2 = mysqli_fetch_assoc($result2);
$total_attendance = $row2['total'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance Dashboard</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI';
    background: linear-gradient(135deg, #667eea, #764ba2);
}

.container {
    width: 90%;
    margin: auto;
    margin-top: 40px;
}

h2 {
    color: white;
}

.cards {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    flex: 1;
    padding: 25px;
    border-radius: 12px;
    color: white;
    text-align: center;
    font-size: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.card1 {
    background: linear-gradient(45deg, #36d1dc, #5b86e5);
}

.card2 {
    background: linear-gradient(45deg, #ff9966, #ff5e62);
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

th, td {
    padding: 12px;
    text-align: center;
}

th {
    background: #667eea;
    color: white;
}

tr:nth-child(even) {
    background: #f2f2f2;
}
</style>

</head>

<body>

<div class="container">

<h2>📊 Attendance Dashboard</h2>

<div class="cards">
    <div class="card card1">
        Total Students <br><br>
        <b><?php echo $total_students; ?></b>
    </div>

    <div class="card card2">
        Total Attendance <br><br>
        <b><?php echo $total_attendance; ?></b>
    </div>
</div>

<table>
<tr>
    <th>ID</th>
    <th>Student Name</th>
    <th>Total Days</th>
    <th>Present Days</th>
    <th>Attendance %</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM students");

while($row = mysqli_fetch_assoc($result)) {

    $id = $row['id'];
    $name = $row['name'];

    // TOTAL DAYS
    $total_days_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM attendance WHERE student_id='$id'");
    $total_days_row = mysqli_fetch_assoc($total_days_query);
    $total_days = $total_days_row['total'];

    // PRESENT DAYS
    $present_query = mysqli_query($conn, "SELECT COUNT(*) AS present FROM attendance WHERE student_id='$id' AND status='Present'");
    $present_row = mysqli_fetch_assoc($present_query);
    $present_days = $present_row['present'];

    // PERCENTAGE
    if($total_days > 0) {
        $percentage = round(($present_days / $total_days) * 100);
    } else {
        $percentage = 0;
    }

    echo "<tr>
        <td>$id</td>
        <td>$name</td>
        <td>$total_days</td>
        <td>$present_days</td>
        <td>$percentage%</td>
    </tr>";
}
?>

</table>

</div>

</body>
</html>
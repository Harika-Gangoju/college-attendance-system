<?php
include("db.php");

$date = date("Y-m-d");

// SAVE ATTENDANCE
if(isset($_POST['submit']) && isset($_POST['attendance'])){

    foreach($_POST['attendance'] as $student_id => $status){

        $student_id = mysqli_real_escape_string($conn, $student_id);
        $status = mysqli_real_escape_string($conn, $status);

        $check = mysqli_query($conn,
            "SELECT id FROM attendance 
             WHERE student_id='$student_id' 
             AND attendance_date='$date'");

        if(mysqli_num_rows($check) == 0){
            mysqli_query($conn,
                "INSERT INTO attendance (student_id, attendance_date, status)
                 VALUES ('$student_id','$date','$status')");
        }
    }

    header("Location: attendance_summary.php?success=1");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Mark Attendance</title>

<style>
body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#667eea,#764ba2);
}

.container{
    width:90%;
    max-width:1000px;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#333;
}

.date{
    text-align:right;
    margin-bottom:15px;
    font-weight:bold;
    color:#555;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#667eea;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f2f2f2;
}

.present{
    color:green;
    font-weight:bold;
}

.absent{
    color:red;
    font-weight:bold;
}

button{
    margin-top:20px;
    width:100%;
    padding:12px;
    background:#667eea;
    color:white;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#5a67d8;
}
</style>

</head>
<body>

<div class="container">

<h2>📋 Mark Attendance</h2>
<div class="date">Date: <?php echo $date; ?></div>

<form method="POST">

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Department</th>
    <th>Present</th>
    <th>Absent</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM students ORDER BY id ASC");

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['branch']; ?></td>

    <td>
        <input type="radio"
        name="attendance[<?php echo $row['id']; ?>]"
        value="Present" required>
    </td>

    <td>
        <input type="radio"
        name="attendance[<?php echo $row['id']; ?>]"
        value="Absent">
    </td>
</tr>

<?php
    }
}else{
    echo "<tr><td colspan='5'>No Students Found</td></tr>";
}
?>

</table>

<button type="submit" name="submit">Submit Attendance</button>

</form>

</div>

</body>
</html>
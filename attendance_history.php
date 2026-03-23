<?php
include("db.php");

 if(isset($_GET['filter_date']) && $_GET['filter_date'] != "") {
    $filter_date = $_GET['filter_date'];

    $query = "SELECT students.name, attendance.attendance_date, attendance.status
              FROM students
LEFT JOIN attendance ON attendance.student_id = students.id 

              WHERE attendance.attendance_date = '$filter_date'
              ORDER BY students.id ASC";
} else {
    $query = "SELECT students.name, attendance.attendance_date, attendance.status
               FROM students
LEFT JOIN attendance ON attendance.student_id = students.id

              ORDER BY attendance.attendance_date DESC, students.id ASC";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance History</title>
<style>
table{
    width:80%;
    margin:40px auto;
    border-collapse:collapse;
}
th, td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
}
th{
    background:#1e3a8a;
    color:white;
}
</style>
</head>
<body>

<h2 style="text-align:center;">Attendance History</h2>
<form method="GET" style="text-align:center; margin-bottom:20px;">
    <input type="date" name="filter_date" required>
    <button type="submit">Filter</button>
</form>

<table>
<tr>
    <th>Student Name</th>
    <th>Date</th>
    <th>Status</th>
</tr>
<tbody>
<?php  
while($row = mysqli_fetch_assoc($result)) { ?> 

<tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['attendance_date']; ?></td>
    <td><?php echo $row['status']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

</body>
</html>
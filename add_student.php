<?php
$conn = new mysqli("localhost", "root", "", "attendance_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $sql = "INSERT INTO students (name, email, department) VALUES ('$name', '$email', '$department')";
    
    if($conn->query($sql) === TRUE){
        echo "Student Added Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Department: <input type="text" name="department" required><br><br>
    <input type="submit" name="submit" value="Add Student">
</form>

</body>
</html>
<?php
session_start();
include "db.php";

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 🔵 Check Teacher
    $teacher_query = "SELECT * FROM teachers WHERE username='$username' AND password='$password'";
    $teacher_result = mysqli_query($conn, $teacher_query);

    if(mysqli_num_rows($teacher_result) == 1){
        $_SESSION['teacher'] = $username;
        header("Location: dashboard.php");
        exit();
    }

    // 🟢 Check Student
    $student_query = "SELECT * FROM students WHERE username='$username' AND password='$password'";
    $student_result = mysqli_query($conn, $student_query);

    if(mysqli_num_rows($student_result) == 1){
        $_SESSION['student'] = $username;
        header("Location: student_view.php");
        exit();
    }

    $error = "Invalid Username or Password!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Login - Attendance System</title>
    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg,#4e73df,#1cc88a);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .login-box{
            background:white;
            padding:40px;
            width:350px;
            border-radius:10px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
            text-align:center;
        }

        h2{
            margin-bottom:20px;
            color:#4e73df;
        }

        input{
            width:100%;
            padding:10px;
            margin:10px 0;
            border:1px solid #ccc;
            border-radius:5px;
        }

        button{
            width:100%;
            padding:10px;
            background:#4e73df;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
            font-size:16px;
        }

        button:hover{
            background:#2e59d9;
        }

        .error{
            color:red;
            margin-top:10px;
        }

        .footer{
            margin-top:15px;
            font-size:12px;
            color:#777;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Teacher Login</h2>

    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <?php
    if(isset($error)){
        echo "<div class='error'>$error</div>";
    }
    ?>

    <div class="footer">
        Online Attendance Tracking System
    </div>
</div>

</body>
</html>
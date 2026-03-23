<?php
session_start();
include("db.php");

if(isset($_POST['login'])){

    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    $query = "SELECT * FROM students 
              WHERE user_id='$student_id' 
              AND password='$password'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['student_id'] = $row['id'];   // store real id
    header("Location: student_dashboard.php");
    exit();
}


 else {
        echo "<script>alert('Invalid Student ID or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-box{
            background:white;
            padding:40px;
            width:350px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
            text-align:center;
        }

        .login-box h2{
            margin-bottom:25px;
            color:#333;
        }

        .input-box{
            margin-bottom:20px;
            text-align:left;
        }

        .input-box label{
            font-weight:bold;
            font-size:14px;
        }

        .input-box input{
            width:100%;
            padding:10px;
            margin-top:5px;
            border-radius:8px;
            border:1px solid #ccc;
            outline:none;
            transition:0.3s;
        }

        .input-box input:focus{
            border-color:#667eea;
            box-shadow:0 0 5px #667eea;
        }

        .login-btn{
            width:100%;
            padding:10px;
            border:none;
            border-radius:8px;
            background:#667eea;
            color:white;
            font-size:16px;
            cursor:pointer;
            transition:0.3s;
        }

        .login-btn:hover{
            background:#5a67d8;
        }

        .footer-text{
            margin-top:15px;
            font-size:13px;
            color:#777;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Student Login</h2>

   <form method="POST" autocomplete="off">

    <!-- Fake fields to trick Chrome -->
    <input type="text" name="fake_user" style="display:none">
    <input type="password" name="fake_pass" style="display:none">

    <div class="input-box">
        <label>Student ID</label>
        <input type="text" name="student_id" required autocomplete="off">
    </div>

    <div class="input-box">
        <label>Password</label>
        <input type="password" name="password" required autocomplete="new-password">
    </div>

    <button type="submit" name="login" class="login-btn">Login</button>

</form>
    <div class="footer-text">
        Attendance Management System
    </div>
</div>

</body>
</html>
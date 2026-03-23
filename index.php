<!DOCTYPE html>
<html>
<head>
    <title>Attendance Management System</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            width: 350px;
        }

        h1 {
            margin-bottom: 30px;
            color: #333;
        }

        .btn {
            display: block;
            text-decoration: none;
            padding: 12px;
            margin: 15px 0;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            transition: 0.3s;
        }

        .teacher {
            background: #667eea;
            color: white;
        }

        .student {
            background: #764ba2;
            color: white;
        }

        .btn:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>Attendance System</h1>
    <a href="login.php" class="btn teacher">Teacher Login</a>
    <a href="student_login.php" class="btn student">Student Login</a>
</div>

</body>
</html>
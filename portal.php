<!DOCTYPE html>
<html>
<head>
    <title>Attendance Portal</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            width: 350px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .role-btn {
            display: block;
            margin: 15px 0;
            padding: 12px;
            text-decoration: none;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        .student {
            background: #4e73df;
        }

        .teacher {
            background: #1cc88a;
        }

        .admin {
            background: #e74a3b;
        }

        .role-btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Choose Your Role</h2>

    <a href="student_login.php" class="role-btn student">🎓 Student Login</a>
    <a href="teacher.php" class="role-btn teacher">👩‍🏫 Teacher Login</a>
    <!-- Add admin later if needed -->
</div>

</body>
</html>
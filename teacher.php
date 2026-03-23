<?php
session_start();

if(!isset($_SESSION['teacher'])){
    header("Location: teacher_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Teacher Dashboard</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #4facfe, #00f2fe);
}

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #1e293b;
    color: white;
    position: fixed;
    padding: 20px;
}

.sidebar h2 {
    text-align: center;
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    padding: 12px;
    margin: 10px 0;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
}

.sidebar a:hover {
    background: #334155;
}

/* Main Content */
.main {
    margin-left: 240px;
    padding: 30px;
    color: white;
}

.card-container {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.card {
    background: white;
    color: black;
    padding: 20px;
    border-radius: 15px;
    width: 220px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-5px);
}

.card h3 {
    margin: 0;
}

.card a {
    display: inline-block;
    margin-top: 10px;
    padding: 8px 12px;
    background: #4facfe;
    color: white;
    text-decoration: none;
    border-radius: 6px;
}
</style>
</head>

<body>

<div class="sidebar">
    <h2>Teacher</h2>

    <a href="teacher.php">Dashboard</a>
    <a href="mark_attendance.php">Mark Attendance</a>
    <a href="view_attendance.php">View Attendance</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    <h1>Welcome Teacher 👩‍🏫</h1>

    <div class="card-container">

        <div class="card">
            <h3>📋 Mark Attendance</h3>
            <a href="mark_attendance.php">Go</a>
        </div>

        <div class="card">
            <h3>📊 View Attendance</h3>
            <a href="view_attendance.php">Go</a>
        </div>

        <div class="card">
            <h3>📁 Reports</h3>
            <a href="attendance_history.php">Go</a>
        </div>

    </div>
</div>

</body>
</html>
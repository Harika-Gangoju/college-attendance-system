<?php
$conn = new mysqli("localhost", "root", "", "attendance_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#f1f5f9; font-family:Segoe UI, sans-serif;">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="mb-4 text-center">All Students List (45 Students)</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['name']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['phone']."</td>
                            <td>".$row['course']."</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No Students Found</td></tr>";
            }
            ?>

            </tbody>
        </table>
    </div>
</div>

</body>
</html>
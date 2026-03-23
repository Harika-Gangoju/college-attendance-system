<?php
$conn = mysqli_connect("localhost", "root", "", "attendance_db");

if(isset($_POST['submit'])) {

    $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");

   while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        $name = $data[0];
        $roll_no = $data[1];
        $branch = $data[2];
        $email = $data[3];
        $user_id = $data[4];
        $password = $data[5];

        mysqli_query($conn, "INSERT INTO students(name, roll_no, branch, email, user_id, password)
        VALUES('$name','$roll_no','$branch','$email','$user_id','$password')");
    }

    echo "Students Uploaded Successfully!";
}
?>

<form method="post" enctype="multipart/form-data">
    Select CSV File:
    <input type="file" name="file" required>
    <input type="submit" name="submit" value="Upload">
</form>
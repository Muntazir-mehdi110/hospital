<?php

session_start();

if (isset($_SESSION["user"])) {
    if (($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a') {
        header("location: ../login.php");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}

// Import database
include("../connection.php");

if ($_POST) {
    // Get form data
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $spec = $_POST['spec'];
    $email = $_POST['email'];
    $tele = $_POST['Tele'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if passwords match
    if ($password == $cpassword) {

        // Check if email already exists in webuser table
        $result = mysqli_query($database, "SELECT * FROM webuser WHERE email='$email'");

        if ($result->num_rows == 1) {
            // If email exists, show error message and stop
            echo "<script>alert('Error: Email already exists!'); window.location.href='doctors.php';</script>";
            exit();
        } else {
            // Insert doctor data into doctor table
            $sql1 = "INSERT INTO doctor (docemail, docname, docpassword, docnic, doctel, specialties) 
                     VALUES ('$email','$name','$password','$nic','$tele',$spec)";
            mysqli_query($database, $sql1);

            // Insert email and user type into webuser table
            $sql2 = "INSERT INTO webuser VALUES ('$email','d')";
            mysqli_query($database, $sql2);

            // Success message and redirect
            echo "<script>alert('Doctor added successfully!'); window.location.href='doctors.php';</script>";
            exit();
        }

    } else {
        // If passwords don't match
        echo "<script>alert('Error: Password and Confirm Password do not match!'); window.location.href='doctors.php';</script>";
        exit();
    }

} else {
    // If form not submitted properly
    echo "<script>alert('Error: Please submit the form properly!'); window.location.href='doctors.php';</script>";
    exit();
}
?>

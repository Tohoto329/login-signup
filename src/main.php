<?php

$servername = "localhost";
$username = "form";
$password = "";
$database = "mydb";

$conn = mysqli_connect(
    $servername,
    $Email,
    $password,
    $database
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = $_POST["Email"];
    $password = $_POST["password"];
    $Confirm_password = $_POST["Confirm password"];

    $sql = "Select * from mysql where Email='$username'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if ($num == 0) {
        if (($password == $Confirm_password) && $exists == false) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO `mysql` ( `username`, 
                `password`, `date`) VALUES ('$username', 
                '$hash', current_timestamp())";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    } // end if 

    if ($num > 0) {
        $exists = "Username not available";
    }
}
<?php
include 'connection.php';
include 'utility.php';
session_start();
if (!(empty($_POST["username"]) && empty($_POST["password"]) && empty($_POST["email"]))) {
    // print_r($_POST);
    extract($_POST);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $email = mysqli_real_escape_string($conn, $email);
    // echo $username . " " . $password . " " . $email . " ";
    $qr = "INSERT INTO user VALUES(NULL,'$username','$password','$email',NULL)";
    $res = mysqli_query($conn, $qr);
    if ($res) {
        $st = 1;
        $msg = "User registeration successfully ";
    } else {
        $st = 0;
        $msg = "Something went wrong !, User is not registered" . mysqli_error($conn);
    }
    $_SESSION["st"]["msg"] = [$st, $msg];
    $printmsg = printmsg();
    return $printmsg;
} else {
    echo "Something went wrong, You can't access";
    header("location:index.php");
}

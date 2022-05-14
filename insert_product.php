<?php

include 'connection.php';
include 'utility.php';
session_start();
if (isset($_SESSION["user"])) {
    if (sizeof($_POST) >= 4 && isset($_FILES["file"])) {
        extract($_POST);
        $isfileupload = upload_file();
        // print_r($isfileupload);
        if (!$isfileupload[0]) {
            $_SESSION["st"]["msg"] = [0, $isfileupload[1]];
            // header("location:product.php");
            // exit();
            return printmsg();
        }
        $filename = $_FILES["file"]["name"];
        $p_name = mysqli_real_escape_string($conn, $p_name);
        $price = mysqli_real_escape_string($conn, $price);
        $upc = mysqli_real_escape_string($conn, $upc);
        $filename = mysqli_real_escape_string($conn, $filename);
        $status = mysqli_real_escape_string($conn, $status);
        $qr = "INSERT INTO product VALUES(NULL,'$p_name','$price','$upc','$filename','$status',NULL)";
        $res = mysqli_query($conn, $qr);
        if ($res) {
            $_SESSION["st"]["msg"] = [1, "Product inserted successfully"];
        } else {
            $_SESSION["st"]["msg"] = [0, "Product not inserted !" . mysqli_error($conn)];
        }
        // header("location:product.php");


    } else {
        $_SESSION["st"]["msg"] = [0, "You can not insert empty field "];
    }
    return printmsg();
} else {
    header("location:login.php");
}

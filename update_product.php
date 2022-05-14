<?php

include 'connection.php';
include 'utility.php';
session_start();
if (isset($_SESSION["user"])) {

    if (sizeof($_POST) >= 4 && isset($_POST["pid"])) {
        extract($_POST);
        $filename = $imgname;
        if (!empty($_FILES["file"]["name"])) {
            $isfileupload = upload_file();

            if (!$isfileupload[0]) {
                $_SESSION["st"]["msg"] = [0, $isfileupload[1]];
                return printmsg();
                exit();
            }
            $filename = $_FILES["file"]["name"];
        }
        $p_name = mysqli_real_escape_string($conn, $p_name);
        $price = mysqli_real_escape_string($conn, $price);
        $upc = mysqli_real_escape_string($conn, $upc);
        $filename = mysqli_real_escape_string($conn, $filename);
        $status = mysqli_real_escape_string($conn, $status);
        $qr = "UPDATE product SET p_name='$p_name',price='$price',upc='$upc',`image`='$filename',`status`='$status' WHERE id=$pid";
        $res = mysqli_query($conn, $qr);
        if ($res) {
            $_SESSION["st"]["msg"] = [1, "Product updated successfully"];
        } else {
            $_SESSION["st"]["msg"] = [0, "Product not updated !" . mysqli_error($conn)];
        }
        // header("location:product.php");


    } else {
        $_SESSION["st"]["msg"] = [0, "You can not insert empty field "];
    }
    return printmsg();
} else {
    header("location:login.php");
}

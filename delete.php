<?php

include 'connection.php';
include 'utility.php';
session_start();
// User login checking
if (isset($_SESSION["user"])) {
    // Checking GET request 
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET["pid"])) {
            $qr = "DELETE FROM product WHERE id = $_GET[pid]";
            $res = mysqli_query($conn, $qr);
        }
    }
    // Checking POST request 
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $arr = $_POST["p_id"];
        $qr = "";
        foreach ($arr as $id) {
            $qr .= "DELETE FROM product WHERE id=$id;";
        }
        $res = mysqli_multi_query($conn, $qr);
    } else {
        $_SESSION["st"]["msg"] = [0, "You can't delete"];
    }

    //Checking query is fired or not
    if ($res) {
        $_SESSION["st"]["msg"] = [1, "Product has been deleted "];
    } else {
        $_SESSION["st"]["msg"] = [0, "Product not deleted"];
    }
    // Send msg
    printmsg();
} else {
    header("location:login.php");
}

<?php

$conn = mysqli_connect("localhost", "root", "", "practical_db");
if (!$conn) {
    die("Database not connected " . mysqli_connect_error());
}

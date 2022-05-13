<?php

$conn = mysqli_connect("localhost", "root", "", "practical_db");
if (!$conn) {
    echo "database not connected";
}

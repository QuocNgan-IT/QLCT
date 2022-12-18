<?php
// define("HOST", "localhost");
// define("USER", "root");
// define("PASS", "");
// define("DB", "quanlychitieu");
$HOST = "localhost";
$USER = "root";
$PASS = "";
$DB   = "quanlychitieu";

$conn = mysqli_connect($HOST, $USER, $PASS, $DB) or die ('Không thể kết nối tới database');
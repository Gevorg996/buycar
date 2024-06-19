<?php
$conn = new mysqli("localhost", "", "", "");
if ($conn->connect_error) {
	die("connection error:" . $conn->connect_error);
}
$conn->set_charset("utf8");
?>
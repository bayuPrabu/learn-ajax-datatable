<?php 
// koneksi database
include "config.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];
$address = $_POST["address"];
$date = $_POST["date"];
$query = "INSERT INTO bayu_ajax_crud VALUES ('', '$fname', '$lname', '$gender', '$address', '$date')";
$error = $db->error;

// Jalankan Fungsi SImpan Data
if($_POST["type"] == "insert") {
	$sql = $db->query($query) or die($error);
} 	

?>
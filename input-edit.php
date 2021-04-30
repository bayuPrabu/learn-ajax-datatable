<?php 
include "config.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$gender = $_POST["gender"];
$address = $_POST["address"];
$date = $_POST["date"];
$id_edit = $_POST["id"];

$query = "UPDATE bayu_ajax_crud SET first_name = '$fname', last_name = '$lname', gender = '$gender', address = '$address', date_of_birth = '$date' 
		  WHERE id = '$id_edit'";
$error = $db->error;

// Jalankan Fungsi Update
if($_POST["type"] == "update") {
	$sql_edit = $db->query($query) or die($error);
}

 ?>
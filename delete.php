<?php 
// koneksi database
include "config.php";

$id = $_POST["id_del"];
$query = "DELETE FROM bayu_ajax_crud WHERE id = '$id'";
$error = $db->error;

// Jalankan Fungsi Delete
if($_POST["type"] == "delete"){
	$sql_delete = $db->query($query) or die($error);
}

 ?>
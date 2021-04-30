<?php 
// koneksi Database
include "config.php";

// get data search dari script.js
$search = $_GET["search"];

// tampung data
$data = [];

// query data 
$sql = $db->query("SELECT * FROM bayu_ajax_crud WHERE first_name LIKE '%$search%' OR 
			 										  last_name LIKE '%$search%' OR 
			 										  gender LIKE '%$search%' OR
			 										  address LIKE '%$search%' OR
			 										  date_of_birth LIKE '%$search%' ORDER BY first_name ASC");

// looping data 
while($row = $sql->fetch_object()){
	$data[] = $row;
}

// cetak data 
echo json_encode($data);

 ?>

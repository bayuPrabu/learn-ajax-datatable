<?php 
// koneksi Database
include "config.php";

// tampung data
$data = [];
// query data 
$sql = $db->query("SELECT * FROM bayu_ajax_crud ORDER BY first_name ASC");

// looping data 
while($row = $sql->fetch_object()){
	$data[] = $row;
}
// cetak data 
echo json_encode($data);

 ?>

<?php 
// koneksi database
include "config.php";

// query data edit
$id_edit = $_GET["edit"];
$sql_editShow = $db->query("SELECT * FROM bayu_ajax_crud WHERE id = '$id_edit' ");

// looping data edit
$row_edit = $sql_editShow->fetch_object();

// tampil data edit
echo json_encode($row_edit);

?>
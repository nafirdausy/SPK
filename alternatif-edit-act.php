<?php
require "include/conn.php";
$id = $_POST['id_alternatif'];
$nama_alternatif = $_POST['name_alternatif'];
$sql = "UPDATE alternatif SET name='$nama_alternatif' WHERE id_alternatif='$id'";
$result = $db->query($sql);
header("location:./alternatif.php");

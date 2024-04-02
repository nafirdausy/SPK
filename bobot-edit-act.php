<?php
require "include/conn.php";
$id = $_POST['id_kriteria'];
$nama_kriteria = $_POST['nama_kriteria'];
$bobot_kriteria = $_POST['bobot_kriteria'];
$attribute = $_POST['attribute'];

$sql = "UPDATE kriteria SET nama_kriteria='$nama_kriteria',bobot_kriteria='$bobot_kriteria',attribute='$attribute' WHERE id_kriteria='$id_kriteria'";
$result = $db->query($sql);
header("location:./bobot.php");

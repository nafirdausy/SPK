<?php
require "include/conn.php";

$id_alternatif = $_POST['id_alternatif'];
$id_kriteria = $_POST['id_kriteria'];
$nilai = $_POST['nilai'];

$sql = "INSERT INTO nilai_evaluasi values ('$id_alternatif','$id_kriteria','$nilai')";
$result = $db->query($sql);

if ($result === true) {
    header("location:./matrik.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

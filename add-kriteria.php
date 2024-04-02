<?php
require "include/conn.php";

$nama_kriteria = $_POST['nama_kriteria'];
$bobot_kriteria = $_POST['bobot_kriteria'];
$attribute = $_POST['attribute'];
$sql = "INSERT INTO saw_criterias (id_criteria,nama_kriteria,bobot_kriteria,attribute) VALUES ('$nama_kriteria','$bobot_kriteria',$attribute')";

if ($db->query($sql) === true) {
    header("location:./bobot.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

<?php
require "include/conn.php";
$nama_alternatif = $_POST['nama_alternatif'];
// $x = $db->query($sql);
// var_dump($x);
$sql = "INSERT INTO alternatif (name) VALUES ('$nama_alternatif')";

if ($db->query($sql) === true) {
    header("location:./alternatif.php");
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}


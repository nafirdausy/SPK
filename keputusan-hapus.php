<?php
require "include/conn.php";
$id_alternatif = $_GET['id_alternatif'];
mysqli_query($db, "delete from nilai_evaluasi where id_alternatif='$id_alternatif'");

header("location:./matrik.php");

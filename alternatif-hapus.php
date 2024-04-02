<?php
require "include/conn.php";
$id_alternatif = $_GET['id_alternatif'];
mysqli_query($db, "delete from alternatif where id_alternatif='$id_alternatif'");
header("location:./alternatif.php");

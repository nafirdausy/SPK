<?php
include 'include/conn.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = $db->query("select * from usesr where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
//$cek = $login->num_rows;

if ($cek > 0) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:index.php");
} else {

    header("location:login.php");
    //echo "Login gagal. Username atau password salah.";

}
?>
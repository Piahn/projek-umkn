<?php 
include "koneksi.php";

session_start();
if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, md5($_POST['password']));

    // Query untuk admin
    $query_admin = mysqli_query($koneksi, "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'");
    $cek_admin = mysqli_num_rows($query_admin);
    $a = mysqli_fetch_array($query_admin);

    // Query untuk user
    $query_user = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");
    $cek_user = mysqli_num_rows($query_user);
    $u = mysqli_fetch_array($query_user);

    if ($cek_admin > 0) {
        // Jika login sebagai admin
        $_SESSION['id_admin'] = $a['id_admin'];
        $_SESSION['username'] = $a['username'];
        $_SESSION['email'] = $a['email'];
        $_SESSION['password'] = $a['password'];


        if(!empty($_POST['remember'])) {
            setcookie("username", $_POST['username'], time() + (60 * 60 * 24 * 5));
            setcookie("password", $_POST['password'], time() + (60 * 60 * 24 * 5));
        } else {
            setcookie("username", "");
            setcookie("password", ""); 
        }

        // Redirect langsung ke halaman admin dengan parameter
        header("Location: dashboard.php?page=home");
        exit();
    } else if ($cek_user > 0) {
        // Jika login sebagai user
        $_SESSION['id_user'] = $u['id_user'];
        $_SESSION['username'] = $u['username'];
        $_SESSION['email'] = $u['email'];
        $_SESSION['password'] = $u['password'];
        $_SESSION['address'] = $u['address'];

        if(!empty($_POST['remember'])) {
            setcookie("username", $_POST['username'], time() + (60 * 60 * 24 * 5)); 
            setcookie("password", $_POST['password'], time() + (60 * 60 * 24 * 5));     
        } else {
            setcookie("username", "");
            setcookie("password", ""); 
        }
        // Redirect langsung ke halaman user dengan parameter
        header("Location: home.php?page=home");
        exit();
    } else {
        // Jika login gagal
        echo "<script>alert('Password atau Username anda salah'); window.location = 'index.php'</script>";
    }
}
?>

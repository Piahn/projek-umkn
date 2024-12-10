<?php 
session_start();
session_destroy();

echo "<script>alert('Anda Telah Keluar system!'); window.location = 'index.php'</script>";
?>
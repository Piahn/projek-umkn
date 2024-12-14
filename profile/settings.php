<style>
.container {
  max-width: 400px;
  margin: 0 auto;
  padding: 30px;
  background-color: var(--card-bg);
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  margin-top: 5rem;
}

.account-form {
  display: grid;
  grid-gap: 20px;
}

.form-group {
  display: grid;
  grid-template-columns: 1fr 2fr;
  align-items: center;
}

.form-group label {
  font-weight: bold;
  color: #333;
}

.form-group input {
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.form-group input:focus {
  outline: none;
  border-color: var(--primary-color);
}

.update-button {
  background-color: var(--primary-color);
  color: white;
  padding: 12px 24px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
}

.update-button:hover {
  background-color: #45a049;
}
</style>


<div class="container">
  <h2>Pengaturan Akun</h2><br>
  <form class="account-form" action="" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" placeholder="Enter your username" required>
    </div>
    <!-- <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>
    </div> -->
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="form-group">
      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required>
    </div>
    <button type="submit" name="submit" class="update-button">Update</button>
  </form>
  <?php 
  if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conf_pass = $_POST['confirm-password'];
    $id_user = $_SESSION['id_admin'];

    if($password ==$conf_pass) {
      $password_5 = md5($password);
      mysqli_query($koneksi, "UPDATE tbl_admin SET username='$username', password='$password_5' WHERE id_admin='$id_user'");
      echo "<script>alert('Berhasil di ubah'); window.location = 'dashboard.php?page=profile'</script>";
    } else {
      echo "<script>alert('Password Salah/Tidak sama') window.location = 'dashboard.php?page=profile'</script>";
    }
  }
  
  ?>
</div>
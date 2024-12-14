<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modern Registration Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        a {
            color: white;
            text-decoration: none;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .register-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px;
            width: 450px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .register-title {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .input-group input {
            width: 100%;
            padding: 15px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: white;
            font-size: 16px;
            outline: none;
            transition: all 0.3s ease;
        }

        .input-group label {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .input-group input:focus {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
            background: rgba(255, 255, 255, 0.3);
        }

        .input-group input:focus + label,
        .input-group input:not(:placeholder-shown) + label {
            top: -20px;
            left: 0;
            font-size: 12px;
            color: white;
        }

        .register-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-top: 10px;
        }

        .register-btn:hover {
            transform: scale(1.05);
        }

        .name-group {
            /* display: flex; */
            justify-content: space-between;
        }

        /* .name-group .input-group {
            width: 48%;
        } */

        .terms-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .terms-group input[type="checkbox"] {
            margin-right: 10px;
            accent-color: #6a11cb;
        }

        .terms-group label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
        }

        .login-link a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="register-title">Create an Account</h2>
        <form action="cekregister.php" method="post">
            <div class="name-group">
            <div class="input-group">
                <input type="email" name="email" placeholder=" " required>
                <label>Email Address</label>
            </div><br>
            <div class="input-group">
                <input type="text" name="username" placeholder=" " required>
                <label>Username</label>
            </div><br>
            <div class="input-group">
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div><br>
            <div class="input-group">
                <input type="password" name="password_require" placeholder=" " required>
                <label>Confirm Password</label>
            </div>
            </div>
            <div class="terms-group">
                <input type="checkbox" id="terms" required>
                <label for="terms">I agree to the Terms and Conditions</label>
            </div>
            <button class="register-btn" type="submit"><a href="index.php">Sign Up</button>
        </form>
        <?php 
            if(isset($_POST['submit'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password_require = $_POST['password_require'];
                $email = $_POST['email'];

                mysqli_query($koneksi, "INSERT * FROM tbl_user" ('username', 'password', 'email') VALUES ('$password', $username, $email) )
                if($password == $password_require) {
                    echo "<script>alert('pendaftaran telah berhasil'); window.location = 'index.php';</script>";
                } else {
                    echo "<script>alert('pendaftaran gagal'); window.location = 'register.php';</script>";
                }

            }  
            ?>
        <div class="login-link">
            Already have an account? <a href="index.php">Login</a>
        </div>
    </div>
</body>
</html>
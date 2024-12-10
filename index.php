<?php 
session_start(); // Memulai sesi
if((empty($_SESSION['username'])) and (empty($_SESSION['password'])))  {
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modern Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            padding: 40px;
            width: 400px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .login-title {
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

        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, #6a11cb 0%, #2575fc 100%);
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .login-btn:hover {
            transform: scale(1.05);
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.8);
        }

        .signup-link a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="login-title">Welcome Back</h2>
        <form action="ceklogin.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="" value="<?php echo (isset($_COOKIE['username'])) ? $_COOKIE['username']: ''; ?>" required>
                <label>Username</label>
            </div><br>
            <div class="input-group">
                <input type="password" name="password" placeholder="" value="<?php echo (isset($_COOKIE['password'])) ? $_COOKIE['password']: '';?>" required>
                <label>Password</label>
            </div>
            <div class="terms-group">
                <input type="checkbox" id="terms" name="remember">
                <label for="terms">I agree to the Terms and Conditions</label>
            </div>
            <button type="submit" name="submit" class="login-btn">Login</button>
        </form>
        <div class="signup-link">
            Don't have an account? <a href="register.php">Sign Up</a>
        </div>
    </div>
</body>
</html>

<?php  
} else {
    echo "<script>window.history.go(-1)</script>";
}
?>


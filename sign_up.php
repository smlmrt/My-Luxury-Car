<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = ""; // Message Variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "cars";

    // Creat Connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check Connection
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Take Data of POST
    $user = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Prepare SQL Query
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, is_admin) VALUES (?, ?, ?, ?)");

    // Connect Parameters
    $stmt->bind_param("sssi", $user, $email, $pass, $is_admin);

    // Run query and check the result
    if ($stmt->execute()) {
        $message = "<p style='color:orange; text-align:center;'>Kayıt başarılı!</p>";
    } else {
        $message = "<p style='color:red; text-align:center;'>Hata: " . $stmt->error . "</p>";
    }

    // Connection Close
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LUXURY-CARS Sign Up Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="images/png" href="images/logo.png">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: #000;
        }

        body::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0.5;
            width: 100%;
            height: 100%;
            background: url("images/Porsche.jpeg");
            background-position: center;
        }

        nav {
            position: fixed;
            padding: 25px 60px;
            z-index: 1;
        }

        nav a img {
            width: 167px;
            border-radius: 15px; /* Köşeleri yuvarlatıyoruz */
        }

        .form-wrapper {
            position: absolute;
            left: 50%;
            top: 50%;
            border-radius: 4px;
            padding: 70px;
            width: 450px;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, .50);
        }

        .form-wrapper h2 {
            color: #fff;
            font-size: 2rem;
        }

        .form-wrapper form {
            margin: 25px 0 65px;
        }

        form .form-control {
            height: 50px;
            position: relative;
            margin-bottom: 16px;
        }

        .form-control input {
            height: 100%;
            width: 100%;
            background: #333;
            border: none;
            outline: none;
            border-radius: 4px;
            color: #fff;
            font-size: 1rem;
            padding: 0 50px 0 20px; /* Sağ padding arttırıldı */
        }

        .form-control input:is(:focus, :valid) {
            background: #444;
            padding: 16px 50px 0 20px;
        }

        .form-control label {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1rem;
            pointer-events: none;
            color: #8c8c8c;
            transition: all 0.1s ease;
        }

        .form-control input:is(:focus, :valid)~label {
            font-size: 0.75rem;
            transform: translateY(-130%);
        }

        .form-control i {
            position: absolute;
            right: 20px; /* İkonu sağ tarafa yerleştirir */
            top: 50%;
            transform: translateY(-50%);
            color: #8c8c8c;
            font-size: 1.25rem;
        }

        form button {
            width: 100%;
            padding: 16px 0;
            font-size: 1rem;
            background: #e50914;
            color: #fff;
            font-weight: 500;
            border-radius: 4px;
            border: none;
            outline: none;
            margin: 25px 0 10px;
            cursor: pointer;
            transition: 0.1s ease;
        }

        form button:hover {
            background: #c40812;
        }

        .form-wrapper a {
            text-decoration: none;
        }

        .form-wrapper a:hover {
            text-decoration: underline;
        }

        .form-wrapper :where(label, p, small, a) {
            color: #b3b3b3;
        }

        form .form-help {
            display: flex;
            justify-content: space-between;
        }

        form .remember-me {
            display: flex;
        }

        form .remember-me input {
            margin-right: 5px;
            accent-color: #b3b3b3;
        }

        form .form-help :where(label, a) {
            font-size: 0.9rem;
        }

        .form-wrapper p a {
            color: #fff;
        }

        @media (max-width: 740px) {
            body::before {
                display: none;
            }

            nav, .form-wrapper {
                padding: 20px;
            }

            nav a img {
                width: 140px;
            }

            .form-wrapper {
                width: 100%;
                top: 43%;
            }

            .form-wrapper form {
                margin: 25px 0 40px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <a href="#"><img src="images/logo.png" alt="logo"></a>
    </nav>
    <div class="form-wrapper">
        <h2>Sign Up</h2>
        <?php if(!empty($message)) { echo $message; } ?>
        <form action="" method="POST">
            <div class="form-control">
                <input type="text" name="username" placeholder="Username" required>
                <i class="fas fa-user"></i>
            </div>
            <div class="form-control">
                <input type="email" name="email" placeholder="Email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="form-control">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <div class="form-control">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <i class="fas fa-lock"></i>
            </div>
            <div class = "check-box">
                <input type="checkbox" name="is_admin" id="is_admin">
                <label for="is_admin" style="color: #fff;">Admin</label>
            </div>
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(item => {
            item.addEventListener('click', function() {
                let input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.replace('bxs-lock-alt', 'bxs-lock-open-alt');
                } else {
                    input.type = 'password';
                    this.classList.replace('bxs-lock-open-alt', 'bxs-lock-alt');
                }
            });
        });

        // Password confirmation check
        document.querySelector('form').addEventListener('submit', function(event) {
            let password = document.getElementById('password').value;
            let confirm_password = document.getElementById('confirm_password').value;

            if (password !== confirm_password) {
                alert("Passwords do not match!");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>

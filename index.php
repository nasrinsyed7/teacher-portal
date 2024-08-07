<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $con->prepare("SELECT * FROM teachers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['teacher_id'] = $user['id'];
            header('Location: home.php');
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Portal - Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="box">
        <h1>Tailwebs.</h1>
        <div class="container">
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
            <form method="POST" action="">
                <div class="input-field">
                    <label for="username">Username</label>
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="username" class="input" placeholder="Username" required>
                </div>
                <div class="input-field">
                    <label for="password">Password</label>
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="input" placeholder="Password" required>
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="check">
                        <label for="check">Remember Me</label>
                    </div>
                    <div class="two">
                        <label for="#"><a href="#">Forgot Password?</a></label>
                    </div>
                </div>
                <div class="submit">
                    <button class="btn" type="submit">Login</button>
                </div>
                <div class="reg">
                    <a href="register.php">Click here! to Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

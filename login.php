<?php
session_start();

include('connection.php');
include('functions.php');

if (isset($_SESSION['user'])) {
    header('Location: registry.php');
    exit;
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registry</title>
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Script&display=swap" rel="stylesheet">
</head>
<body style="background-color: #c0b6a8">
<header id="header-registry">
    <div class="container">
        <div class="header-text">
            <a href="index.html"><p>Mustafa & Aya</p></a>
        </div>
    </div>
</header>

<main class="login-main">
    <div class="login-page">
        <div class="form">
            <form class="login-form" method="post" action="">
                <input type="text" name="name" placeholder="Your Name" required/>
                <input type="password" name="code" placeholder="Invitation Code" required/>
                <button type="submit" class="form-btn" name="sub">Login</button>
                <span class="reg-text">Or <a href="register.php">Register</a> now!</span>
            </form>
            <?php
            if (isset($loginError)) {
                echo '<p class="error-message">' . $loginError . '</p>';
            }
            ?>
        </div>
    </div>
</main>
</body>
</html>

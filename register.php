<?php
session_start();
include('connection.php');

$amount = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];
    $amount = $_POST['amount'];


    $sql = "INSERT INTO guest_registration (name, code, money) VALUES ('$name', '$code', '$amount')";

    $rs = mysqli_query($con, $sql);

    if ($rs) {
        header('Location: login.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($con);

    }
}

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

<main class="register-main">
    <div class="register-page">
        <div class="form">
            <form class="register-form" action="" method="post">
                <input type="text" id="name" name="name" placeholder="Your Name"/>
                <input type="password" id="code" name="code" placeholder="Invitation Code"/>
                <input type="number" name="amount" id="amount" placeholder="Amount of money you want to add"/>
                <button type="submit" id="submit" value="submit" name="submit" class="form-btn">Register</button>
                <span class="reg-text">Or <a href="login.php">Login</a> now!</span>
            </form>
        </div>
    </div>
</main>
</body>
</html>
<?php
session_start();
include('connection.php');

if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];

    $stmt = mysqli_prepare($con, "SELECT id, name, money FROM guest_registration WHERE name=? AND code=?");
    mysqli_stmt_bind_param($stmt, "ss", $name, $code);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Set the 'id' key in the user session
        $_SESSION['user'] = $user;

        header('Location: registry.php');
        exit;
    } else {
        $loginError = "Login failed. Please check your Code or Name.";
    }

    mysqli_stmt_close($stmt);
}

function logout() {
    session_start();

    $_SESSION = array();

    session_destroy();

    header('Location: login.php');
    exit;
}


<?php

if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $code = $_POST['code'];

    $sql = "SELECT * FROM guest_registration WHERE name='$name' AND code='$code'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = [
            'name' => $user['name'],
            'money' => $user['money']
        ];
        header('Location: registry.php');
        exit;
    } else {
        $loginError = "Login failed. Please Check your Code or Name";
    }
}

function logout() {
    session_start();

    $_SESSION = array();

    session_destroy();

    header('Location: login.php');
    exit;
}

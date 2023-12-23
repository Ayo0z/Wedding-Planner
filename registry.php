<?php
session_start();
include('connection.php');
include('functions.php');

?>

<!DOCTYPE html>
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
<body>
<header id="header-registry">
    <div class="container">
        <div class="header-text">
            <a href="index.html"><p>Mustafa & Aya</p></a>
        </div>
        <div class="acc-info">
            <?php
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                $name = $user['name'];
                $money = $user['money'];

                echo "<p class='loggedin-user'> Welcome <span class='guest_name'>$name</span>! Your current balance: <span class='guest_money'>$money €</span></p>";

                echo '<form method="post" action="">
                             <button class="form-btn" type="submit" name="logout">Logout</button>
                      </form>';

                if (isset($_POST['logout'])) {
                    logout();
                }
            } else {
                echo '<a href="login.php"> <button class="form-btn">Login</button> </a>';
            }
            ?>

        </div>
    </div>
</header>
<?php
$query = "SELECT * FROM items WHERE is_available = 1";
$result = mysqli_query($con, $query);

echo '<main id="registry-main">
    <div class="container">';

$itemCount = 0;
while ($row = mysqli_fetch_assoc($result)) {
    if ($itemCount % 3 === 0) {
        echo '<div class="row">';
    }

    echo '<div class="item">
        <div class="img-box">
            <a href="moneyChecker.php?item=' . $row['id'] . '&price=' . $row['price'] . '"><img src="' . $row['img_src'] . '" alt="..."></a>
        </div>
        <div class="content-box">
            <h2>' . $row['name'] . '</h2>
            <p>' . $row['price'] . '€</p>
            <a href="moneyChecker.php?item=' . $row['id'] . '&price=' . $row['price'] . '" class="buy-btn">Buy this Gift</a>
        </div>
    </div>';

    $itemCount++;

    if ($itemCount % 3 === 0) {
        echo '</div>';
    }
}
if ($itemCount % 3 !== 0) {
    echo '</div>';
}

echo '</div>
</main>';
?>
<footer>
    <div class="back-to-top">
        <a href="#registry-main">
            <svg xmlns="http://www.w3.org/2000/svg" height="80" width="80" viewBox="0 0 512 512">
                <path fill="#f5f3e9"
                      d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/>
            </svg>
            <p>Back to Top</p>
        </a>
    </div>
    <p>Created by Aya Farooq</p>
</footer>


</body>
</html>
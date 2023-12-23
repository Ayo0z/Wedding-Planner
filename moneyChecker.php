<?php
session_start();

include('connection.php');
include('functions.php');


?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanks page</title>
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Script&display=swap" rel="stylesheet">
</head>
<body style="background-color: #c0b6a8">
<header id="header-thanks">
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

                if (isset($_GET['item']) && isset($_GET['price'])) {
                    $item = $_GET['item'];
                    $giftCost = floatval($_GET['price']);

                    if (isset($_POST['submit'])) {
                        $amountToAdd = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;

                        if ($amountToAdd > 0) {
                            $newMoney = $money + $amountToAdd;

                            $updateMoneyQuery = "UPDATE guest_registration SET money=$newMoney WHERE name='$name'";
                            mysqli_query($con, $updateMoneyQuery);

                            $_SESSION['user']['money'] = $newMoney;

                            echo "<p class='loggedin-user'>Money added successfully! Your new balance is: <span class='guest_money'>$newMoney €</span></p>";

                            header('Location: registry.php');
                            exit;
                        } else {
                            echo "<p class='loggedin-user'>Please enter a valid amount to add.</p>";
                        }
                    }

                    if ($money >= $giftCost) {
                        $newMoney = $money - $giftCost;

                        $updateMoneyQuery = "UPDATE guest_registration SET money=$newMoney WHERE name='$name'";
                        mysqli_query($con, $updateMoneyQuery);

                        $_SESSION['user']['money'] = $newMoney;

                        $updateItemQuery = "UPDATE items SET is_available = 0 WHERE id = $item";
                        mysqli_query($con, $updateItemQuery);

                        echo "<p class='loggedin-user'>Thank you for your purchase <span class='guest_name'>$name</span>! Your new balance is: <span class='guest_money'>$newMoney €</span></p>";

                        header('Location: registry.php');
                        exit;
                    } else {
                        echo "<p class='loggedin-user'>Not enough funds. Please add money to your account.</p>";

                        echo '<div class="form" style="max-width: 100%!important; margin: 20px 0 0;">
                <form style="margin-block-end: 0;" class="register-form" action="" method="post">
                    <input style="margin: 0; " type="number" name="amount" id="amount" placeholder="Amount of money you want to add"/>
                    <button type="submit" id="submit" value="submit" name="submit" class="form-btn">Add more money</button>
                </form>
            </div>';
                    }

                    echo '<a href="registry.php">
                <button class="form-btn" type="submit" name="registry">Go back to Shop</button>
            </a>';
                }
            } else {
                echo '<p class="loggedin-user">You are not logged in. Please <a href="login.php">log in</a> to continue.</p>';
            }

            mysqli_close($con);
            ?>
        </div>
    </div>
</header>

</body>
</html>

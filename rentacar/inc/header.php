<?php
require 'function.php';
 session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <title>Rent A Car</title>
</head>
<body>
<header>
    <div class="container">
        <div class="header-content">
            <div class="logo">
                <a href="index.php">
                    <h3>Rent A Car</h3>
                </a>
            </div>
            <div class="navbar">
                <ul class="nav-items">
                    <?php if (isset($_SESSION['id']) && $_SESSION['roli'] == 'Klient') { ?>
                        <li><a class="active" href="index.php">Home</a></li>
                        <li><a href="automjetet.php">Automjetet</a></li>
                        <li><a href="rezervimet.php">Rezervimet</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><i class="fa fa-user"></i><?php echo $_SESSION['emri'] . " ". $_SESSION['mbiemri']; ?></li>

                    <?php } elseif (isset($_SESSION['id']) && $_SESSION['roli'] == 'Staf') { ?>
                        <li><a class="active" href="index.php">Home</a></li>
                        <li><a href="automjetet.php">Automjetet</a></li>
                        <li><a href="rezervimet.php">Rezervimet</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><i class="fa fa-user"></i><?php echo $_SESSION['emri'] . " ". $_SESSION['mbiemri']; ?></li>

                    <?php } elseif (isset($_SESSION['id']) && $_SESSION['roli'] == 'Administrator') { ?>
                        <li><a class="active" href="index.php">Home</a></li>
                        <li><a href="automjetet.php">Automjetet</a></li>
                        <li><a href="kategorite.php">Kategorite</a></li>
                        <li><a href="rezervimet.php">Rezervimet</a></li>
                        <li><a href="perdoruesit.php">Perdoruesit</a></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><i class="fa fa-user"></i><?php echo $_SESSION['emri'] . " " . $_SESSION['mbiemri']; ?></li>
                    <?php } else { ?>
                        <li><a class="active" href="index.php">Home</a></li>
                        <li><a href="automjetet.php">Automjetet</a></li>
                        <li><a href="login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</header>

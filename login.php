<?php
include_once 'inc/function.php';
session_start();
?>
<?php
    if(isset($_SESSION['id'])){
        echo "<script>
        alert('You are already logged in!');
        window.location.href='index.php';
        </script>";
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rent a Car</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
</head>

<body id="loginPage">

<header class="header">
    <div class="logo">
        <a href="index.php">
            <h3>Rent A Car</h3>
        </a>
    </div>
</header>

<?php

if (isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    login($email, $password);
}

?>

<div class="loginForma container">
    <div class="formaLogin">
        <h1>Login</h1>
        <form id="login" method="post" action="#">
            <div>
                <input type="text" id="email" name="email" placeholder="email" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email'];?>"> <br>
                <input type="password" name="password" id="password" placeholder="password">
            </div>

            <div class="loginFormFooter">
                <span>Nuk keni akoma account? <br> <a href="regjistrohu.php">Regjistrohu</a></span> <br>
                <button id="login" name="login" href="#">Login</button>
            </div>
        </form>
    </div>
</div>

</body>


<script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script>
            $("#login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {

                    password: {
                        required: "Ju lutem shkruani passwordin",
                        minlength: "Passwordi duhet te kete me shume se 5 karaktere"
                    },
                    email: {
                        required: "Ju lutem shkruani emailin",
                        email: "Ju lutem shkruani nje email valid"
                    }
                }

            });
            </script>
</html>
<link rel="stylesheet" href="style1.css">
<?php
include_once 'inc/function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rent a Car</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
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
if (isset($_POST['regjistrohu'])) {
    $emri = $_POST['emri'];
    $mbiemri = $_POST['mbiemri'];
    $email = $_POST['email'];
    $telefoni = $_POST['telefoni'];
    $nr_personal = $_POST['nrpersonal'];
    $adresa = $_POST['adresa'];
    $password = $_POST['password'];
    regjistrohu($emri, $mbiemri, $email, $password, $telefoni, $nr_personal, $adresa);

    // header("Location: login.php");
}
?>

<div class="loginForma container">
    <div class="formaLogin">
        <h1>Register</h1>
        <form id="register" method="post" action="#">
            <div>
                <input type="text" name="emri" id="emri" placeholder="Emri"> <br>
                <input type="text" name="mbiemri" id="mbiemri" placeholder="Mbiemri">
            </div>
            <div>
                <input type="email" name="email" id="email" placeholder="email"> <br>
                <input type="text" name="telefoni" id="telefoni" placeholder="telefoni">
            </div>
            <div>
                <input type="text" name="nrpersonal" id="nrpersonal" placeholder="Numri personal"> <br>
                <input type="text" name="adresa" id="adresa" placeholder="Adresa">
            </div>
            <div>
                <input type="password" name="password" id="password" placeholder="password">
            </div>
            <div class="loginFormFooter">
                <button id="login" name="regjistrohu" href="#">Regjistrohu</button>
            </div>
        </form>
    </div>
    <div class="loginFormButton">
       <a href="login.php"> <input type="button" value="Back to login"> </a>
       </div>
</div>

</body>
<script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script>
            $("#register").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    emri: {
                        required: true,
                        minlength: 3,
                        lettersonly: true
                    },
                    mbiemri: {
                        required: true,
                        minlength: 3,
                        lettersonly: true
                    },
                    telefoni: {
                        required: true,
                        minlength: 8,
                        number: true
                    },
                    nrpersonal:{
                        required: true,
                        minlength: 12,
                        number: true
                    },
                    adresa:{
                        required: true
                    }
                },
                messages: {

                    password: {
                        required: "Ju lutem shenoni passwordin",
                        minlength: "Passwordi duhet te kete 5 ose me shume karaktere"
                    },
                    email: {
                        required: "Ju lutem shenoni emailin",
                        email: "Ju lutem shenoni nje email valid"
                    },
                    emri: {
                        required: "Ju lutem shenoni emrin",
                        minlength: "Emri juaj duhet te kete 3 ose me shume karaktere",
                        lettersonly: "Emri duhet te kete vetem shkronja"
                    },
                    mbiemri:{
                        required: "Ju lutem shenoni mbiemrin",
                        minlength: "Mbiemri juaj duhet te kete 3 ose me shume karaktere",
                        lettersonly: "Mbiemri duhet te kete vetem shkronja"
                    },
                    telefoni: {
                        required: "Ju lutem shenoni numrin e telefonit",
                        minlength: "Numri juaj i telefonit duhet te kete 8 ose me shume numra",
                        number: "Numri i telefonit duhet te kete vetem numra"
                },
                nrpersonal:{
                        required: "Ju lutem shkruani numrin personal",
                        minlength: "Numri personal duhet te kete me shume se 12 numra",
                        number: "Numri personal duhet te kete vetem numra"
                },
                adresa:{
                    required: "Ju lutem shenoni adresen"
                }
            }
            
        });
        jQuery.validator.addMethod("lettersonly", function(value, element) {
                return this.optional(element) || /^[a-z]+$/i.test(value);
            }, "Vetem shkronja te lutem");
        

        </script>
</html>

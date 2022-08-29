<?php
include 'inc/header.php';
?>

<section class="section-shto-modifiko container">
    <div class="image">
        <img src="img/clients.jpg" alt="">
    </div>
<?php
    if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator"){
    }else{
        header("Location: index.php");
    }
    ?>

    <?php




        if (isset($_POST['shtoPerdorues']))
        {
            $emri = $_POST['emri'];
            $mbiemri = $_POST['mbiemri'];
            $roli = $_POST['roli'];
            $nrPersonal = $_POST['nrPersonal'];
            $email = $_POST['email'];
            $nr_telefonit = $_POST['nr_telefonit'];
            $adresa = $_POST['adresa'];
            $res = shtoPerdorues($emri, $mbiemri, $email, '123123123', $nr_telefonit, $nrPersonal, $adresa, $roli);
            if ($res) {
                header('Location: perdoruesit.php');
            }
        }



        if (isset($_POST['modifikoPerdorues']))
        {
            $perdoruesiId = $_GET['perdoruesiid'];
            $emri = $_POST['emri'];
            $mbiemri = $_POST['mbiemri'];
            $roli = $_POST['roli'];
            $nrPersonal = $_POST['nrPersonal'];
            $email = $_POST['email'];
            $nr_telefonit = $_POST['nr_telefonit'];
            $adresa = $_POST['adresa'];
            $role = $_POST['roli'];
            $res = modifikoPerdorues($perdoruesiId, $emri, $mbiemri, $email, $nr_telefonit, $nrPersonal, $adresa, $role);
            if ($res) {
                header('Location: perdoruesit.php');
            }
        }
    ?>



    <div class="forma">
        <br>
        <br>
        <?php
        if (isset($_GET['perdoruesiid'])) {
            $perdoruesi = mysqli_fetch_assoc(merrPerdoruesId($_GET['perdoruesiid']));
            echo "<h1>Forma per modifikimin e Perdoruesit</h1>";
        } else {
            echo "<h1>Forma per shtimin e Perdoruesit</h1>";
        }
        ?>
        <br>
        <form id="valid" method="post" action="#">
            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri" value="<?php if (isset($_GET['perdoruesiid'])) echo $perdoruesi['emri']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="mbiemri">Mbiemri</label> <br>
                <input type="text" id="mbiemri" name="mbiemri" value="<?php if (isset($_GET['perdoruesiid'])) echo $perdoruesi['mbiemri']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="roli">Roli</label> <br>
                <select id="roli" name="roli">
                    <option value="Klient" <?php if (isset($_GET['perdoruesiid'])) if ($perdoruesi['role'] == 'Klient') echo 'selected'; ?>>Klient</option>
                    <option value="Staf" <?php if (isset($_GET['perdoruesiid'])) if ($perdoruesi['role'] == 'Staf') echo 'selected'; ?>>Staf</option>
                    <option value="Administrator" <?php if (isset($_GET['perdoruesiid'])) if ($perdoruesi['role'] == 'Administrator') echo 'selected'; ?>>Administrator</option>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="nrPersonal">Nr personal</label> <br>
                <input type="text" id="nrPersonal" name="nrPersonal" value=" <?php if (isset($_GET['perdoruesiid'])) echo $perdoruesi['nrpersonal']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="email">Email</label> <br>
                <input type="email" id="email" name="email" value="<?php if (isset($_GET['perdoruesiid'])) echo $perdoruesi['email']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="tel">Nr telefonit</label> <br>
                <input type="tel" id="tel" name="nr_telefonit" value="<?php if (isset($_GET['perdoruesiid'])) echo $perdoruesi['telefoni']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="adresa">Adresa</label> <br>
                <input type="text" id="adresa" name="adresa" value="<?php if (isset($_GET['perdoruesiid'])) echo $perdoruesi['adresa']; ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if(isset($_GET['perdoruesiid'])) : ?>
                        <button id="modifikoPerdorues" name="modifikoPerdorues" class="shtoModifiko">Modifiko Perdorues</button>
                    <?php else : ?>
                        <button id="shtoPerdorues" name="shtoPerdorues" class="shtoModifiko">Shto Perdorues</button>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</section>
<?php
include 'inc/footer.php';
?>

<script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script>
            $("#valid").validate({
                rules: {
                    emri: {
                        required: true,
                        lettersonly: true
                    },
                    mbiemri: {
                        required: true,
                        lettersonly: true

                    },
                    email: {
                        required: true,
                        email: true
                    },
                    nrPersonal:{
                        required: true,
                        numberonly: true
                    },
                    nr_telefonit:{
                        required: true,
                        numberonly: true
                    },
                    adresa:{
                        required: true
                    }

                },
                messages: {

                    emri: {
                        required: "Ju lutem shenoni emrin",
                        lettersonly: "Emri juaj duhet te kete vetem shkronja"
                    },
                    mbiemri: {
                        required: "Ju lutem shenoni mbiemrin",
                        lettersonly: "Mbiemri juaj duhet te kete vetem shkronja"
                    },
                    email: {
                        required: "Ju lutem shenoni emailin",
                        email: "Emaili juaj duhet te jete valid"
                    },
                    nrPersonal: {
                        required: "Ju lutem shenoni numrin personal",
                        numberonly: "Numri personal duhet te permbaje vetem numra dhe nuk duhet te kete hapsire"
                    },
                    nr_telefonit: {
                        required: "Ju lutem shkruani numrin e telefonit",
                        numberonly: "Numri i telefonit duhet te permbaje vetem numra"
                    },
                    adresa: {
                        required: "Ju lutem shkruani adresen tuaj"
                    }
                }

            });

            jQuery.validator.addMethod("numberonly", function(value, element) {
  return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Vetem numra te lutem"); 

            jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Vetem shkronja te lutem"); 


            </script>





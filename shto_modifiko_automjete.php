<?php

use LDAP\Result;

include 'inc/header.php';
?>

<section class="section-shto-modifiko container">
    <div class="image">
        <img src="img/car8.jpg" alt="">
        

        <?php
    if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator"){
    }elseif(isset($_SESSION['id']) && $_SESSION['roli'] == "Staf"){       
}else {
    header("Location: index.php");
}
    ?>

        <?php
            if(isset($_POST['modifikoAutomjet'])){
                $automjetiid = $_GET['automjetiid'];
                $emri = $_POST['emri'];
                $kategoriaid = $_POST['kategoria'];
                $nr_regjistrimit = $_POST['nrRegjistrimit'];
                $pershkrimi = $_POST['pershkrimi'];
                $kostoja = $_POST['kostoja'];
                $result = modfikioAutomjet($automjetiid , $kategoriaid , $emri , $nr_regjistrimit , $pershkrimi , $kostoja);
                if($result){
                    header("Location: automjetet.php");
                }
            }
            ?>
            <?php
            if(isset($_POST['shtoAutomjet'])){
                $emri = $_POST['emri'];
                $kategoriaid = $_POST['kategoria'];
                $nr_regjistrimit = $_POST['nrRegjistrimit'];
                $pershkrimi = $_POST['pershkrimi'];
                $kostoja = $_POST['kostoja'];
                $result = shtoAutomjet($emri , $kategoriaid , $nr_regjistrimit , $pershkrimi , $kostoja);
                if($result){
                    header ("Location: automjetet.php");
                }
            }
            
        ?>
    </div>
    <div class="forma">
        <br>
        <br>
        <?php
        if(isset($_GET['automjetiid'])){
            $automjeti = mysqli_fetch_assoc(merrAutomjetinID($_GET['automjetiid'])); 
            echo "<h1>Forma per editimin e Automjetit</h1>";
    }else {
        echo  "<h1>Forma per shtimin e Automjetit</h1>";
    }
        ?>
        <br>
        <form id="automjete" method = "post" action="#">
            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['emri']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="kategoria">Kategoria</label> <br>
                <select id="kategoria" name="kategoria">
                    <?php
                    $kategorite = merrKategorite();
                    if ($kategorite) {
                        while ($kategoria = mysqli_fetch_assoc($kategorite)) {
                            echo '<option value="'.$kategoria['kategoriaid'].'">'.$kategoria['emri'].'</option>'; 
                        }
                    }
                        ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="nrRegjistrimit">Numri i regjistrimit</label> <br>
                <input type="text" id="nrRegjistrimit" name="nrRegjistrimit" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['nr_regjistrimi']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="pershkrimi">Pershkrimi</label> <br>
                <input type="text" id="pershkrimi" name="pershkrimi" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['pershkrimi']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="kostoja">Kostoja</label> <br>
                <input type="text" id="kostoja" name="kostoja" value="<?php if(isset($_GET['automjetiid'])) echo $automjeti['kostoja']; ?>">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php if(isset($_GET['automjetiid'])) : ?>
                    <button id="modifikoAutomjet" name="modifikoAutomjet" class="shtoModifiko">Modifiko Automjet</button> <br>
                    <?php else :?>
                    <button id="ShtoAutomjet" name="shtoAutomjet" class="shtoModifiko">Shto Automjet</button>
                    <?php endif;?>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
include 'inc/footer.php';
?>
</body>

<script src="jquery-3.6.0.js"></script>
    <script src="slick.min.js"></script>
    <script src="jquery.validate.min.js"></script>
    <script>
            $("#automjete").validate({
                rules: {
                    emri: {
                        required: true,
                        lettersonly: true
                    },
                    nrRegjistrimit: {
                        required: true,
                    },
                    pershkrimi: {
                        required: true,
                    },
                    kostoja:{
                        required: true,
                        numberonly: true
                    }

                },
                messages:  {
                    
                    emri: {
                        required: "Ju lutem shenoni emrin",
                        lettersonly: "Emri juaj duhet te kete vetem shkronja"
                    },
                    nrRegjistrimit: {
                        required: "Ju lutem shenoni numrin e regjistrimit",
                    },
                    pershkrimi: {
                        required: "Ju lutem shenoni pershkrim",
                    },
                    kostoja: {
                        required: "Ju lutem shenoni koston",
                        numberonly: "Kostoja duhet te kete vetem numra"
                    }
                }

            });

            jQuery.validator.addMethod("numberonly", function(value, element) {
  return this.optional(element) || /^[0-9-.]+$/i.test(value);
}, "Vetem numra te lutem"); 

            jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z " "]+$/i.test(value);
}, "Vetem shkronja te lutem"); 
</script>
</html>

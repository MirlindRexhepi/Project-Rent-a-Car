<?php
include 'inc/header.php';
?>
<section class="section-shto-modifiko container">
    <div class="image">
        <img src="img/car10.png" alt="">
    </div>
    <?php
    if(isset($_SESSION['id'])){
    }else{
        header("Location: index.php");
    }
    ?>



    <?php
    
    if(isset($_POST['modifikoRezervim'])){
        $rezervimiid = $_GET['rezervimiid'];
        $perdoruesiId = $_POST['klienti'];
        $automjetiid = $_POST['automjeti'];
        $dataemarrjes = $_POST['data_e_marrjes'];
        $dataekthimit = $_POST['data_e_kthimit'];
        $res = modifikoRezervim($rezervimiid , $perdoruesiId , $automjetiid , $dataemarrjes , $dataekthimit);
        if($res){
            header("Location: rezervimet.php");
        }
    }

    if(isset($_POST['shtoReservim'])){
        $perdoruesiId = $_POST['klienti'];
        $automjetiid = $_POST['automjeti'];
        $dataemarrjes = $_POST['data_e_marrjes'];
        $dataekthimit = $_POST['data_e_kthimit'];
        $res = shtoRezervim($perdoruesiId , $automjetiid , $dataemarrjes , $dataekthimit );
        if($res){
            header("Location: rezervimet.php");
        }

    }

    ?>


    <div class="forma">
        <br>
        <br>
        <?php
             if (isset($_GET['rezervimiid'])) {
                $rezervimi = mysqli_fetch_assoc(rezervimiID($_GET['rezervimiid']));
            echo "<h1>Forma per editimin e Rezervimit</h1>"; 
    }else{
        echo "<h1>Forma per shtimin e Rezervimit</h1>";
    }
        ?>
        <br>
        <form id="rezervim" method ="post" action="#">
         <?php if($_SESSION['roli'] == 'Klient'){?>
            <div hidden class="inputAndLabels">
                <label  for="klienti">Klienti</label> <br>
                    <input type="text" name="klienti" id="klienti" readonly value="<?php if(isset($_SESSION['id'])) echo $_SESSION['id'] ?>">              
            </div>
            <?php } else { ?>
                <label id="klientt" for="klienti">Klienti</label>
                <select id="klienti" name="klienti">
                    <option  value="">Zgjedh Klientin </option>
                    <?php
                     $klient = merrPerdoruesit();
                     if($klient){
                         while($klientet = mysqli_fetch_assoc($klient)){
                             echo '<option value="'.$klientet['perdoruesiid'].'">'.$klientet['emri'].'</option>'; 
                         }
                     }         
                     ?>
                </select>     
            <?php } ?>
            <div class="inputAndLabels">
                <label for="automjeti">Automjeti</label> <br>
                <select id="automjeti" name="automjeti">
                    <option value="">Zgjedh automjetin </option>
                    <?php
                     $automjeti = merrAutomjetet();
                     if($automjeti){
                         while($automjetet = mysqli_fetch_assoc($automjeti)){
                             echo '<option value="'.$automjetet['automjetiid'].'">'.$automjetet['emri'].'</option>'; 
                         }
                     }
                    ?>
                </select>
            </div>
            <div class="inputAndLabels">
                <label for="data_e_marrjes">Data e marrjes</label> <br>
                <input type="date" id="data_e_marrjes" name="data_e_marrjes">
            </div>
            <div class="inputAndLabels">
                <label for="data_e_kthimit">Data e kthimit</label> <br>
                <input type="date" id="data_e_kthimit" name="data_e_kthimit">
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php
                    if(isset($_GET['rezervimiid'])) : ?>
                    <button id="modifikoRezervim" name="modifikoRezervim" class="shtoModifiko">Modifiko Rezerviim</button> <br>
                    <?php else : ?>
                    <button id="shtoReservim" name="shtoReservim" class="shtoModifiko">Shto Rezervim</button>
                    <?php endif;?>
                    
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
            $("#rezervim").validate({
                rules: {
                    automjeti: {
                        required: true
                    },
                    data_e_marrjes: {
                        required: true,
                        date: true
                    },
                    data_e_kthimit: {
                        required: true,
                        date: true
                    },
                    klienti: {
                        required: true,
                    }

                },
                messages: {

                    automjeti: {
                        required: "Ju lutem zgjedhni automjetin",
                    },
                    data_e_marrjes: {
                        required: "Ju lutem zgjedhni daten e marrjes"
                    },
                    data_e_kthimit: {
                        required: "Ju lutem zgjedhni daten e kthimit"
                    },
                    klienti: {
                        required: "Ju lutem zgjedhni klientin"
                    }
                }

            });
            </script>

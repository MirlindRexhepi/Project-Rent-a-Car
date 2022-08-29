<?php
include 'inc/header.php';
?>
<section class="section-shto-modifiko container">
    <div class="image">
        <img src="img/car9.jpg" alt="">
    </div>

    <?php
    if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator"){
    }else{
        header("Location: index.php");
    }
    ?>

    <?php
    
    if(isset($_POST['modifikoKategori'])){
        $kategoriaid = $_GET['kategoriaid'];
        $emri = $_POST['emri'];
        $pershkrimi = $_POST['pershkrimi'];
        $res = modifikoKategorite($kategoriaid , $emri , $pershkrimi);
        if($res){
            header("Location: kategorite.php");
        }
    }
    if(isset($_POST['shtoKategori'])){
        $emri = $_POST['emri'];
        $pershkrimi= $_POST['pershkrimi'];
        $res = shtoKategorite($emri , $pershkrimi);
        if($res){
            header("Location: kategorite.php");
        }
    }
    
    
    ?>

    <div class="forma">
        <br>
        <br>
        <?php
        if(isset($_GET['kategoriaid'])){
            $kategoria = mysqli_fetch_assoc(merrKategoriteID($_GET['kategoriaid']));
             echo "<h1>Forma per editimin e Kategorisë</h1>";
    }else {
        echo "<h1>Forma per shtimin e Kategorisë</h1>";
    }
        ?>
        <br>
        <form id="kategorit" method = "post" action="#">
            <div class="inputAndLabels">
                <label for="emri">Emri</label> <br>
                <input type="text" id="emri" name="emri" value="<?php if(isset($_GET['kategoriaid'])) echo $kategoria['emri']; ?>">
            </div>
            <div class="inputAndLabels">
                <label for="pershkrimi">Pershkrimi</label> <br>
                <textarea id="pershkrimi" name="pershkrimi" rows="10"><?php if(isset($_GET['kategoriaid'])) echo $kategoria['pershkrimi']; ?></textarea>
            </div>
            <div class="inputAndLabels">
                <div class="butonat">
                    <?php if(isset($_GET['kategoriaid'])) : ?>
                    <button id="modifikoKategori" name="modifikoKategori" class="shtoModifiko">Modifiko Kategori</button> <br>
                    <?php else :?>
                    <button id="shtoKategori" name="shtoKategori" class="shtoModifiko">Shto Kategori</button>
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
            $("#kategorit").validate({
                rules: {
                    emri: {
                        required: true,
                        lettersonly: true
                    },
                    pershkrimi: {
                        required: true,
                    }

                },
                messages: {

                    emri: {
                        required: "Ju lutem shkruani emrin",
                        lettersonly: "Emri duhet te kete vetem shkronja"
                    },
                    pershkrimi: {
                        required: "Ju lutem plotesojeni pershkrimin"
                    },
                }

            });
            jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Vetem shkronja te lutem");
            </script>

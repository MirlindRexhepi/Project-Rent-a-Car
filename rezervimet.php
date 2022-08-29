<?php
include 'inc/header.php';
?>
<?php
if(!isset($_SESSION['id'])){
header("Location: index.php");
}
?>
<section class="list-entity container">
    <div class="image">
        <img src="img/car10.png" alt="">
    </div>
    <table class="styled-table">
        <thead>
        <tr>
            <th>Emri</th>
            <th>Mbiemer</th>
            <th>Automobili</th>
            <th>Nr. regjistrimit</th>
            <th>Kategoria</th>
            <th>Data e marrjes</th>
            <th>Data e kthimit</th>
            <?php
            if(isset($_SESSION['id'])){
            echo "<th>Modifiko</th>";
            echo  "<th>Fshiej</th>";
        }
        ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $rezervimet = merrRezervimet();
        if ($rezervimet) {
            while ($rezervimi = mysqli_fetch_assoc($rezervimet)) {
                echo "<td>" . $rezervimi['perdoruesi_emri'] . "</td>";
                echo "<td>" . $rezervimi['perdoruesi_mbiemrei'] . "</td>";
                echo "<td>" . $rezervimi['automejti_emri'] . "</td>";
                echo "<td>" . $rezervimi['nr_regjistrimi'] . "</td>";
                echo "<td>" . $rezervimi['kategoria_emri'] . "</td>";
                echo "<td>" . $rezervimi['dataemarrjes'] . "</td>";
                echo "<td>" . $rezervimi['dataekthimit'] . "</td>";
                if(isset($_SESSION['id'])){
                echo "<td><a href='shto_modifiko_rezervim.php?rezervimiid=".$rezervimi['rezervimiid'] . "'><i class='fas fa-edit'></i></a></td>";
                ?>
                <td>
             <form action="fshij_rezervimin.php" method="post">
                    <input type="text" name="rezervimiid" hidden value="<?php echo $rezervimi['rezervimiid']; ?>">
                    <button type="submit" style="border: none;background-color:transparent;cursor:pointer;"
                                    name="btnFshij" onclick="return fshijrezervimin()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <script>
                            function fshijrezervimin() {
                                $confirm = confirm('A jeni te sigurt qe doni ta fshini rezervimin?');
                                if ($confirm) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }

                        </script>
                        <?php } ?>
                    </td>
                    <?php
                    echo "</tr>";
            }
        }
        ?>
        </td>
        </tbody>
    </table>
    <a href="shto_modifiko_rezervim.php" id="add_entity"><i class="fas fa-plus"></i> Shto Rezervim</a>
</section>

<?php
include 'inc/footer.php';
?>

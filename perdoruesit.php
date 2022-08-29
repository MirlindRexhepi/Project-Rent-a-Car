<?php
include 'inc/header.php';
?>
<?php
    if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator"){
    }else{
        header("Location: index.php");
    }
?>
<section class="list-entity container">
    <div class="image">
        <img src="img/clients.jpg" alt="">
    </div>
    <div class="filter">
        <form action="" method="post">
            <input type="radio" name="filter" value="te_gjithe" checked>
            <label for="te_gjithe">Te gjith | </label>
            <input type="radio" name="filter" value="klient">
            <label for="te_gjithe">Klientet | </label>
            <input type="radio" name="filter" value="staf">
            <label for="te_gjithe">Staf | </label>
            <input type="radio" name="filter" value="administrator">
            <label for="te_gjithe">Administratoret</label>
            <input type="submit" name="filtro" class="btn-filtro" value="Filtro">
        </form>
    </div>
    <table class="styled-table">
        <thead>
        <tr>
            <th>Emri</th>
            <th>Mbiemri</th>
            <th>Roli</th>
            <th>Nr personal</th>
            <th>Email</th>
            <th>Nr telefonit</th>
            <th>Modifiko</th>
            <th>Fshiej</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $result = merrPerdoruesit();
        if ($result) {
            while ($perdoruesi = mysqli_fetch_assoc($result)) {

                echo "<tr class='active-row'>";
                echo "<td>" . $perdoruesi['emri'] . "</td>";
                echo "<td>" . $perdoruesi['mbiemri'] . "</td>";
                echo "<td>" . $perdoruesi['role'] . "</td>";
                echo "<td>" . $perdoruesi['nrpersonal'] . "</td>";
                echo "<td>" . $perdoruesi['email'] . "</td>";
                echo "<td>" . $perdoruesi['telefoni'] . "</td>";
                echo "<td><a href='shto_modifiko_perdorues.php?perdoruesiid=".$perdoruesi['perdoruesiid'] . "'><i class='fas fa-edit'></i></a></td>";

                ?>
                    <td>
                <form action="fshij_perdorues.php" method="post">
                    <input type="text" name="perdoruesiid" hidden value="<?php echo $perdoruesi['perdoruesiid']; ?>">

                    <button type="submit" style="border: none;background-color:transparent;cursor:pointer;"
                                    name="btnFshij" onclick="return fshijperdorues()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <script>
                            function fshijperdorues() {
                                $confirm = confirm('A jeni te sigurt qe doni ta fshini perdoruesin?');
                                if ($confirm) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }

                        </script>
                    </td>
        <?php
        echo '</tr>';

            }
        }
        ?>


        </tbody>
    </table>
    <a href="shto_modifiko_perdorues.php" id="add_entity"><i class="fas fa-plus"></i> Shto Perdorues</a>
</section>

<?php
include 'inc/footer.php';
?>

<?php
include 'inc/header.php';
?>
<section class="list-entity container">
    <div class="image">
        <img src="img/car9.jpg" alt="">
    </div>

    <table class="styled-table">
        <thead>
        <tr>
            <th>Emri</th>
            <th>Pershkrimi</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $result = merrKategorite();
            if($result){
                while($kategorite = mysqli_fetch_assoc($result)){
                    echo "<tr class='active-row'>";
                    echo "<td>" . $kategorite['emri'] . "</td>";
                    echo "<td>" . $kategorite['pershkrimi'] . "</td>";
                    echo "<td><a href='shto_modifiko_kategori.php?kategoriaid=". $kategorite['kategoriaid'] . "'><i class='fas fa-edit'></i></a></td>";
                    ?>

                    <form action="fshij_kategorite.php" method="post">
                        <td>
                        <input type="text" name="kategoriaid" hidden value="<?php  echo $kategorite['kategoriaid']; ?>">

                        <button type="submit" style="border: none;background-color:transparent;cursor:pointer;"
                                    name="btnFshij" onclick="return fshijkategorine()">
                                    <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <script>
                            function fshijkategorine() {
                                $confirm = confirm('A jeni te sigurt qe doni ta fshini kategorine ?');
                                if ($confirm) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }

                        </script>

                        </button>
                        </td>
                    </form>

                    <?php
                   "</tr>";
                }
            }
        ?>
        </tbody>
    </table>
    <a href="shto_modifiko_kategori.php" id="add_entity"><i class="add_entity fas fa-plus"></i> Shto Kategori</a>
</section>

<?php
include 'inc/footer.php';
?>

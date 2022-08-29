<?php
include 'inc/header.php'
?>
<section class="list-entity container">
    <div class="image">
        <img src="img/car7.jpg" alt="">
    </div>
    <table class="styled-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Kategoria</th>
            <th>Numri i regjistrimit</th>
            <th>Pershkrimi</th>
            <th>Kostoja</th>
            <?php
            if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator"){
            echo "<th>Modifiko</th>";
            echo  "<th>Fshiej</th>";
        }elseif (isset($_SESSION['id']) && $_SESSION['roli'] == "Staf") {
            echo "<th>Modifiko</th>";
            echo  "<th>Fshiej</th>";
        }
       
            ?>
        </tr>
        </thead>
        <tbody>
            <?php
            $result = merrAutomjetet();
            if($result){
                while($automjetet = mysqli_fetch_assoc($result)){
                  echo  "<tr class='active-row'>";
                    echo "<td>" .$automjetet['automjetet_emri'] . "</td>";
                    echo "<td>" .$automjetet['kategorie_emri'] . "</td>";
                    echo "<td>" .$automjetet['automjetet_nr_regjistrimi'] . "</td>";
                    echo "<td>" .$automjetet['automjetet_pershkrimi'] . "</td>";
                    echo "<td>" .$automjetet['automjetet_kostoja'] . "</td>";
                    if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator"){
                    echo "<td><a href='shto_modifiko_automjete.php?automjetiid=".$automjetet['automjetiid'] . "'><i class='fas fa-edit'></i></a></td>";
                    ?>
                    <td>
                <form action="fshij_automjet.php" method="post">
                    <input type="text" name="automjetiid" hidden value="<?php echo $automjetet['automjetiid']; ?>">

                    <button type="submit" style="border: none;background-color:transparent;cursor:pointer;"
                                    name="btnFshij" onclick="return fshijautomjet()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <script>
                            function fshijautomjet() {
                                $confirm = confirm('A jeni te sigurt qe doni ta fshini automjetin?');
                                if ($confirm) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        <?php } ?>
                            
                        </script>
                        
                    </td>


        
        <?php if(isset($_SESSION['id']) && $_SESSION['roli'] == "Staf"){
                    echo "<td><a href='shto_modifiko_automjete.php?automjetiid=".$automjetet['automjetiid'] . "'><i class='fas fa-edit'></i></a></td>";
                    ?>
                    <td>
                <form action="fshij_automjet.php" method="post">
                    <input type="text" name="automjetiid" hidden value="<?php echo $automjetet['automjetiid']; ?>">

                    <button type="submit" style="border: none;background-color:transparent;cursor:pointer;"
                                    name="btnFshij" onclick="return fshijautomjet()">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                        <script>
                            function fshijautomjet() {
                                $confirm = confirm('A jeni te sigurt qe doni ta fshini automjetin?');
                                if ($confirm) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                      <?php  } ?>
                            
                        </script>

<?php
                }
            }
      
        ?>
                        
                    </td>

 
        </tbody>
    </table>
    
    <?php if(isset($_SESSION['id']) && $_SESSION['roli'] == "Administrator") { ?>
    <a href="shto_modifiko_automjete.php" id="add_entity"><i class="fas fa-plus"></i> Shto Automjet</a>
    <?php } ?>
</section>

<?php
include 'inc/footer.php'
?>

<?php

use LDAP\Result;

$dbcon = '';
dbConnection();
function dbConnection()
{
    global $dbcon;
    $dbcon = mysqli_connect('localhost', 'root', '', 'rent a car');
    if (!$dbcon) {
        die("Lidhja me DB deshtoi" . mysqli_error($dbcon));
    }
}



function login($email, $fjalekalimi)
{
    global $dbcon;
    $sql = "SELECT * FROM perdoruesit where email = '$email'";
    $result = mysqli_query($dbcon, $sql);
    if ($result) {
        $res = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 1) {
            if ($fjalekalimi === $res['fjalekalimi']) {
                header('Location: index.php');
                session_start();

                $_SESSION['id'] = $res['perdoruesiid'];
                $_SESSION['emri'] = $res['emri'];
                $_SESSION['mbiemri'] = $res['mbiemri'];
                $_SESSION['roli'] = $res['role'];
            } else {
                    echo "<script>alert('Email ose Fjalekalimi nuk eshte ne rregull!')</script>";
            }
        }
    } else {
        echo "<script>alert('Email ose Password nuk eshte ne rregull!')</script>";
    }
}

function regjistrohu($emri, $mbiemri, $email, $fjalekalimi, $telefoni, $nr_personal, $adresa)
{
    global $dbcon;
    $sql = "SELECT * FROM perdoruesit WHERE email = '$email'";
    $result = mysqli_query($dbcon, $sql);
    if ($result) {
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO perdoruesit(emri, mbiemri, email, fjalekalimi , nrpersonal, telefoni, adresa, role)";
            $sql .= "VALUES('$emri','$mbiemri','$email','$fjalekalimi','$nr_personal', '$telefoni','$adresa','Klient')";
            $result1 = mysqli_query($dbcon, $sql);
            if ($result1) {
                login($email , $fjalekalimi);
            }
        } else {
            echo "<script>alert('Ekziston nje llogari me kete email!');</script>";
        }
    }
}




function merrPerdoruesit()
{
    global $dbcon;
    $sql = "SELECT * FROM perdoruesit";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}


function merrPerdoruesId($perdoruesiId)
{
    global $dbcon;
    $sql = "SELECT * FROM perdoruesit WHERE perdoruesiid=$perdoruesiId";
    $result = mysqli_query($dbcon, $sql);
    return $result;
}

function shtoPerdorues($emri, $mbiemri, $email, $fjalekalimi, $nr_telefonit, $nrPersonal, $adresa, $roli)
{
    global $dbcon;
    $sql = "INSERT INTO `perdoruesit`
    ( `emri`, `mbiemri`, `email`, `fjalekalimi`, `telefoni`, `nrpersonal`, `adresa`, `role`)
    VALUES
           ('$emri','$mbiemri','$email','$fjalekalimi','$nr_telefonit','$nrPersonal','$adresa','$roli')";
    $result = mysqli_query($dbcon, $sql);
    if ($result) {
        return true;
    }
    return false;
}

function modifikoPerdorues($perdoruesiId, $emri, $mbiemri, $email, $telefoni, $nr_personal, $adresa, $role){
    global $dbcon;
    $sql = "UPDATE perdoruesit SET emri = '$emri', mbiemri = '$mbiemri', email = '$email', telefoni = '$telefoni',
            nrpersonal = '$nr_personal', adresa = '$adresa', role = '$role' WHERE perdoruesiid = $perdoruesiId ";
    $result = mysqli_query($dbcon, $sql);
     return $result;
}

function fshijPerdorues($perdoruesiid)
{
    global $dbcon;
    $sql = "DELETE FROM perdoruesit WHERE perdoruesiid = $perdoruesiid";
    $result = mysqli_query($dbcon, $sql);
    return  $result;
}


/** Funksionet per Rezervim */

function merrRezervimet()
{
    $perdoruesiid=$_SESSION['id'];
    global $dbcon;
    $sql = 'SELECT *, perdoruesit.emri AS perdoruesi_emri, perdoruesit.mbiemri AS perdoruesi_mbiemrei, automjetet.emri AS automejti_emri, automjetet.nr_regjistrimi, kategorite.emri AS kategoria_emri
FROM rezervimet
INNER JOIN perdoruesit ON perdoruesit.perdoruesiid = rezervimet.perdoruesiID
INNER JOIN automjetet ON automjetet.automjetiid = rezervimet.automjetiid
INNER JOIN kategorite ON kategorite.kategoriaid = automjetet.kategoriaid';
if (isset($_SESSION['id']) && $_SESSION['roli'] != 'Staf' && $_SESSION['roli']!= 'Administrator'){
    $sql .= " WHERE perdoruesit.perdoruesiid = $perdoruesiid";
}
    $result = mysqli_query($dbcon, $sql);
    return $result;
}
function rezervimiID($id){
    global $dbcon;
    $sql = "SELECT * FROM rezervimet WHERE rezervimiid = $id";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}

function modifikoRezervim($rezervimiid , $perdoruesiId , $automjetiid ,  $dataemarrjes , $dataekthimit){
    global $dbcon;
    $sql = "UPDATE `rezervimet` SET `perdoruesiID`='$perdoruesiId' , `automjetiid`='$automjetiid',
    `dataemarrjes`='$dataemarrjes',`dataekthimit`='$dataekthimit' WHERE rezervimiid=$rezervimiid";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function shtoRezervim($perdoruesiID , $automjetiid , $dataemarrjes , $dataekthimit){
    global $dbcon;
    $sql = "INSERT INTO `rezervimet`(`perdoruesiID`, `automjetiid`, `dataemarrjes`, `dataekthimit`) VALUES 
    ('$perdoruesiID','$automjetiid','$dataemarrjes','$dataekthimit')";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function fshijRezervim($id){
    global $dbcon;
    $sql = "DELETE FROM `rezervimet` WHERE `rezervimiid`='$id'";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}

/** funksionet per kategorine */
function merrKategorite()
{
    global $dbcon;
    $sql = 'SELECT * FROM kategorite';
    $result = mysqli_query($dbcon, $sql);
    return $result;
}
function merrKategoriteID($id){
    global $dbcon;
    $sql = "SELECT * FROM kategorite WHERE kategoriaid='$id'";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function fshijKategorite($id){
    global $dbcon;
    $sql = "DELETE FROM kategorite WHERE kategoriaid='$id'";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function modifikoKategorite($kategoriaid , $emri , $pershkrimi){
    global $dbcon;
    $sql = "UPDATE kategorite SET emri = '$emri' , pershkrimi = '$pershkrimi' WHERE kategoriaid='$kategoriaid'";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function shtoKategorite($emri , $pershkrimi){
    global $dbcon;
    $sql = "INSERT INTO kategorite(emri, pershkrimi) VALUES ('$emri','$pershkrimi')";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}

/** funksionet per automjetet */
function merrAutomjetet(){
    global $dbcon;
    $sql = 'SELECT * , automjetet.emri AS automjetet_emri, kategorite.emri AS kategorie_emri , automjetet.nr_regjistrimi AS automjetet_nr_regjistrimi ,
        automjetet.pershkrimi AS automjetet_pershkrimi , automjetet.kostoja AS automjetet_kostoja FROM automjetet
        INNER JOIN kategorite ON automjetet.kategoriaid=kategorite.kategoriaid';
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function merrAutomjetinID($id){
    global $dbcon;
    $sql = "SELECT * FROM automjetet WHERE automjetiid = $id";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function shtoAutomjet($emri , $kategoriaid , $nr_regjistrimi , $pershkrimi , $kostoja){
    global $dbcon;
    $sql = "INSERT INTO automjetet (kategoriaid , emri , nr_regjistrimi , pershkrimi , kostoja) VALUES
     ('$kategoriaid' , '$emri' , '$nr_regjistrimi' , '$pershkrimi' , '$kostoja')";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function modfikioAutomjet($automjetiid , $kategoriaid , $emri , $nr_regjistrimi , $pershkrimi , $kostoja){
    global $dbcon;
    $sql = "UPDATE automjetet SET emri ='$emri', kategoriaid = '$kategoriaid' , nr_regjistrimi = '$nr_regjistrimi' , pershkrimi = '$pershkrimi' , kostoja = '$kostoja' WHERE automjetiid = $automjetiid";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}
function fshijAutomjet($automjetiid){
    global $dbcon;
    $sql = "DELETE FROM automjetet WHERE automjetiid = $automjetiid";
    $result = mysqli_query($dbcon , $sql);
    return $result;
}

/** Funksionet e filtrimit */

    function rolefilterStaf(){
        global $dbcon;
        $sql = "SELECT `role` FROM perdoruesit WHERE role = 'Staf'";
        $result = mysqli_query($dbcon , $sql);
        return $result;
    }

?>







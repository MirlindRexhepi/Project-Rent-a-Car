<?php

    include_once 'inc/function.php';
    fshijRezervim($_POST['rezervimiid']);
    header("Location: rezervimet.php");

?>
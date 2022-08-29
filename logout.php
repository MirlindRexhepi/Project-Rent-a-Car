<?php
session_start();
session_destroy();

//unset($_SESSION['id']);
//unset($_SESSION['emri']);
//unset($_SESSION['mbiemri']);
//unset($_SESSION['roli']);

header("Location: index.php");

?>

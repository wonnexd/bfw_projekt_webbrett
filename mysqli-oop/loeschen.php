<?php

require 'inc/datenbank.php';
require 'inc/header.php';

$host = htmlspecialchars($_SERVER['HTTP_HOST']);
$uri = rtrim(dirname(htmlspecialchars($_SERVER['PHP_SELF'])), "/\\");
$extra = 'admin.php';

if ( !isset($_GET['id']) || !is_numeric($_GET['id']) ) {

    header("Location: http://$host$uri/$extra");

}

$id = $_GET['id'];

if ( $stmt = $mysqli->prepare('DELETE FROM begriffe WHERE id=?') ) {

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    
    $mysqli->close();
    header("Location: http://$host$uri/$extra");

}

require 'inc/footer.php';

?>
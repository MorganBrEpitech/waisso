<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = urldecode($_POST['email']);
    $to = "morganb911@free.fr";
    $subject = "Nouveau client inscrit à la newsletter Buitoni";
    $message = urldecode($_POST['email'])."\n".urldecode($_POST['last_name'])."\n".urldecode($_POST['first_name'])."\n".urldecode($_POST['sexe']);
    $headers = "De :" . $from;
    mail($to,$subject,$message, $headers);
?>

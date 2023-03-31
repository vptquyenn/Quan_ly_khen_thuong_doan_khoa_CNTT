<?php
    require_once 'bootstrap.php';

    use Ct271\Labs\B1910439;

    $b1910439 = new B1910439($PDO);

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['id'])
        && ($b1910439->find($_POST['id'])) !== null
    ) {
        $b1910439->delete();
    } 
    
    redirect("studnet.php");    
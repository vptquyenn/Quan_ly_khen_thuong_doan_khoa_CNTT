<?php
    require_once 'bootstrap.php';

    use Ct271\Labs\Dangki439;

    $dangki439 = new Dangki439($PDO);

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['id'])
        && ($dangki439->find($_POST['id'])) !== null
    ) {
        $dangki439->delete();
    } 
    
    redirect("dangki439.php");   
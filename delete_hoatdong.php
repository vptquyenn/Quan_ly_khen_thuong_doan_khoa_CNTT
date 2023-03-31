<?php
    require_once 'bootstrap.php';

    use Ct271\Labs\Hoatdong;

    $hoatdong = new Hoatdong($PDO);

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['id'])
        && ($hoatdong->find($_POST['id'])) !== null
    ) {
        $hoatdong->delete();
    } 
    
    redirect("hoatdong.php");
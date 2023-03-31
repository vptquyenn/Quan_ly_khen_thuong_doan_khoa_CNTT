<?php
    require_once 'bootstrap.php';

    use Ct271\Labs\Khenthuong;

    $khenthuong = new Khenthuong($PDO);

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['id'])
        && ($khenthuong->find($_POST['id'])) !== null
    ) {
        $khenthuong->delete();
    } 
    
    redirect("khenthuong.php");
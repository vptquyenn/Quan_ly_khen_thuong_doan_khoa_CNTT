<?php
    require_once 'bootstrap.php';

    use Ct271\Labs\KTB1910439;

    $ktb1910439 = new KTB1910439($PDO);

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['id'])
        && ($ktb1910439->find($_POST['id'])) !== null
    ) {
        $ktb1910439->delete();
    } 
    
    redirect("khenthuong.php");
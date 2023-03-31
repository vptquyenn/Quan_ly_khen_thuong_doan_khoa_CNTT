<?php
    require_once 'bootstrap.php';

    use Ct271\Labs\Contact;

    $contact = new Contact($PDO);

    if (
        $_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['id'])
        && ($contact->find($_POST['id'])) !== null
    ) {
        $contact->delete();
    } 
    
    redirect("student.php");
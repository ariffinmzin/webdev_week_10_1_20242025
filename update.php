<?php

    include 'Database.php';
    include 'User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $user->updateUser($_POST['matric'], $_POST['name'], $_POST['role']);

    $user->close();

?>
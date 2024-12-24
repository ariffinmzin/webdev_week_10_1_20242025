<?php

    include 'Database.php';
    include 'User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $user->deleteUser($_GET['matric']);

    $db->close();

?>
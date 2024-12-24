<?php

    if($_SERVER['REQUEST_METHOD']==='POST'){
        echo $_POST['name'] . " " . $_POST['username'];
    }
    else
    {
        echo $_GET['name'] . " " . $_GET['username'];
    }


?>
<?php

    session_start();

    if(!$_SESSION['name']){
        echo "<script>alert('Unauthorized access, please login first!')</script>";
        echo "<script>window.location.href='login.php'</script>";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Student Page</h1>

    <?php

        echo "<h4>Hello " . $_SESSION['name'] . "!</h4><br>";

    ?>

    <a href="logout.php"><button>Logout</button></a>
    
</body>
</html>
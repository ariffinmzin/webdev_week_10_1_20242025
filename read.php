<?php

    session_start();

    if(!$_SESSION['name']){
        echo "<script>alert('Unauthorized access, please login first!')</script>";
        echo "<script>window.location.href='login.php'</script>";
    }

    include 'Database.php';
    include 'User.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $result = $user->getUsers();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php 

        echo "<h4>Hello " . $_SESSION['name'] . "!</h4><br>";


    ?>
    <table class="table">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php

            if($result->num_rows > 0){

            while($user = $result->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $user['matric'] ?></td>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['role'] ?></td>
            <td><a class="btn btn-info" href="update_form.php?matric=<?php echo $user['matric']; ?>">Update</a>&nbsp <a class="btn btn-danger" href="delete.php?matric=<?php echo $user['matric']; ?>" onClick="return confirm('Are you sure want to delete?')">Delete</a></td>
        </tr>
        <?php

            }
        }

    ?>
    </table>

    <br><br>

    <a href="logout.php"><button>Logout</button></a>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
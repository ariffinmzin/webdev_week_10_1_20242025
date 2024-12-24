<?php

    include 'User.php';
    include 'Database.php';

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    $userData = $user->getUser($_GET['matric']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
</head>
<body>

    <form action="update.php" method="post">
        <label for="matric">Matric</label>
        <input type="text" name="matric" id="matric" value="<?php echo $userData['matric']; ?>"><br>
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?php echo $userData['name']; ?>"><br>
        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>
        <label for="role">Role</label>
        <select name="role" id="role">
            <?php 
                // $userData['role'] === 'student' ? 'selected' : '' 
            ?>
            <option value="student" <?php if($userData['role'] === 'student') { echo "selected"; } ?>>Student</option>
            <option value="lecturer" <?php if($userData['role'] === 'lecturer') { echo "selected"; } ?>>Lecturer</option>
        </select>
        <input type="submit" value="Update">
        


    </form>
    
</body>
</html>

<?php

    $db->close();

?>
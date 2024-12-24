<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
</head>
<body>

    <form action="insert.php" method="post">
        <label for="matric">Matric</label>
        <input class="form-control" type="text" name="matric" id="matric"><br>
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" id="name"><br>
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" id="password"><br>
        <label for="role">Role</label>
        <select name="role" id="role" class="form-select">
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select>
        <input type="submit" value="Register">
        


    </form>
    
</body>
</html>
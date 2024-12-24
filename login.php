<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<form action="authenticate.php" method="post">
<label for="matric">Matric:</label>
<input type="text" name="matric" id="matric" required><br>
<label for="password">Password:</label>
<input type="password" name="password" id="password" required><br>
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
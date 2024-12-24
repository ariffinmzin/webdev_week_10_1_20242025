<?php

session_start();

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Get values from POST request
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // echo 'Login Successful';

            $_SESSION['name'] = $userDetails['name'];
            setcookie('name', $userDetails['name'], time()+3600);

            if($userDetails['role'] === 'lecturer')
                header('Location:layout.php');
            else
                header('Location:student_page.php');
        } else {
            echo "<script>
                alert('Matric number or password is wrong!');
                window.location.href = 'login.php';
              </script>";
        }
    } else {
        echo 'Please fill in all required fields.';
    }
}
?>
<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $hashedPassword = $userData['password'];

        if (password_verify($password, $hashedPassword)) {
            // Valid credentials, set session variables
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $userData['role'];

            // Redirect to the home page
            header("Location: ../home.php");
            exit();
        } else {
            // Invalid password, redirect to index.php with an error message
            header("Location: ../index.php?error=Invalid%20password.%20Please%20try%20again.");
            exit();
        }
    } else {
        // Email not found, redirect to index.php with an error message
        header("Location: ../index.php?error=Email%20not%20found.%20Please%20register%20first.");
        exit();
    }
}
?>

<?php
include 'config.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $targetDir = "../images/users/"; 
    $fileName = $firstName . '_' . basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $sql = "INSERT INTO users (first_name, last_name, phone, email, password, role, image) 
                VALUES ('$firstName', '$lastName', '$phone', '$email', '$hash', '$role', '$fileName')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = $role;

                header("Location: ../home.php");
                exit(); 
            } else {
                echo "Error while executing SQL query: " . mysqli_error($conn);
            }
        } else {
            echo "Error while moving uploaded file.";
            echo "Debugging info: ";
            print_r($_FILES);
        }
    } else {
        header("Location: ../index.php?error=File%20is%20not%20an%20image");
        exit(); 
    }

    mysqli_close($conn);
}
?>

<?php
session_start();

$validUsername = "admin";
$validPassword = "secure";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['loggedin'] = true;
        header("Location: adminMenu.php");
        exit();
    } else {
        echo '<script>alert("Invalid credentials. Please try again."); window.location.href = "login.php";</script>';
    }
} else {
    header("Location: login.php");
    exit();
}
?>

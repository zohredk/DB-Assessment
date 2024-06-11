<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Menu</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet" type="text/css">
  </head>
<body>
    <section id="admin">
    <h1>Admin Menu</h1>
    <p>Welcome to the admin panel.</p>

    <ul>
        <li><a href="newCabinForm.php">Insert a new cabin</a></li>
        <li><a href="listing.php">Update a cabin</a></li>
        <li><a href="deleteCabin.php">Delete a cabin</a></li>
    </ul>
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
    </section>
</body>
</html>

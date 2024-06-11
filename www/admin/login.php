<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <header> 
        <img src="../images/accommodation.png" alt="Accommodation">
        <h1>Sunnyspot Accommodation</h1>
    </header>
    
    <section id="login">
        <h2>Admin Login</h2>
        <form action="processLogin.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Login">
        </form>
    </section>

    <footer> 
        <a href="../allCabins.php">Back to Home</a> 
    </footer>
</body>
</html>

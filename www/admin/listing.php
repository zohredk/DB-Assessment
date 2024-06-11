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
        <h1>Sunnyspot Accommodation Cabin's</h1>
    </header>
    
    <?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SunnySpot";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all cabins from the database
$sql = "SELECT * FROM Cabin";
$result = $conn->query($sql);

// Check if there are any cabins
if ($result->num_rows > 0) {
    echo "<h2>Select a Cabin to Update:</h2>";
    echo "<ul>";
    // Display the list of cabins with update links
    while ($row = $result->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row["cabinType"]) . " - <a href='updateCabin.php?id=" . $row["cabinID"] . "'>Update</a></li>";
    }
    echo "</ul>";
} else {
    echo "<p>No cabins found.</p>";
}

// Close the database connection
$conn->close();

?>


    <footer> 
        <a href="../adminMenu.php">Back to admin Menu</a> 
    </footer>
</body>
</html>



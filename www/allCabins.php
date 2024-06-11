<!-- Displaying cabin type, description, price per night, price per week and photo file for all the cabins from the database. -->

<?php

// Database connection parameters
$servername = "localhost"; // Adjust if needed
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "SunnySpot";

// Create connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select all cabins
$sql = "SELECT cabinType, cabinDescription, pricePerNight, pricePerWeek, photo FROM Cabin";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sunnyspot Accommodation</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <header> 
      <img src="images/accommodation.png" alt="Accommodation">
      <h1>Sunnyspot Accommodation</h1>
    </header>
    <div id="wrapper">    <section id="cabins">
      <?php
      // Check if there are results and output data of each row
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<article>";
              echo "<h2>" . htmlspecialchars($row["cabinType"]) . "</h2>";
              echo "<img src='images/" . htmlspecialchars($row["photo"]) . "' alt='" . htmlspecialchars($row["cabinType"]) . "'>";
              echo "<p><span>Details: </span>" . htmlspecialchars($row["cabinDescription"]) . "</p>";
              echo "<p><span>Price per night: </span>$" . htmlspecialchars($row["pricePerNight"]) . "</p>";
              echo "<p><span>Price per week: </span>$" . htmlspecialchars($row["pricePerWeek"]) . "</p>";
              echo "</article>";
          }
      } else {
          echo "<p>No cabins found</p>";
      }
      // Close the connection
      $conn->close();
      ?>
    </section>
    </div>
    <footer> 
      <a href="./admin/login.php">Admin</a> 
    </footer>
  </body>
</html>

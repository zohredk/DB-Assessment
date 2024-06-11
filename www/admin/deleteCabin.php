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

// Check if the form is submitted and a cabin is selected for deletion
if(isset($_POST["delete_cabin_id"]) && !empty($_POST["delete_cabin_id"])) {
    $cabinID = $_POST["delete_cabin_id"];

    // Prepare a delete statement
    $sql = "DELETE FROM Cabin WHERE cabinID = ?";

    if($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $cabinID);

        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            // Deletion successful, redirect to the same page
            header("Location: deleteCabin.php");
            exit();
        } else {
            echo "Error: Unable to delete cabin.";
        }

        // Close statement
        $stmt->close();
    }
}

// Fetch all cabins from the database
$sql = "SELECT * FROM Cabin";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Cabin</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <section id="update">
    <h2>Delete Cabin</h2>
    <form action="" method="post">
        <select name="delete_cabin_id">
            <option value="">Select a cabin to delete</option>
            <?php
            // Display the list of cabins with delete option
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["cabinID"] . "'>" . htmlspecialchars($row["cabinType"]) . "</option>";
                }
            }
            ?>
        </select>
        <input type="submit" value="Delete">
    </form>
    </section>
    
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

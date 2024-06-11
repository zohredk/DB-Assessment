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

// Check if cabinID is provided in the URL parameter
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Prepare a select statement
    $sql = "SELECT * FROM Cabin WHERE cabinID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // Fetch result row as an associative array
                $row = $result->fetch_assoc();

                // Retrieve individual field value
                $cabinType = $row["cabinType"];
                $cabinDescription = $row["cabinDescription"];
                $pricePerNight = $row["pricePerNight"];
                $pricePerWeek = $row["pricePerWeek"];
                $photo = $row["photo"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Cabin Details</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h2>Update Cabin Details</h2>
    <form action="updateCabin.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($param_id); ?>">
        <label for="cabinType">Cabin Type:</label><br>
        <input type="text" id="cabinType" name="cabinType" value="<?php echo htmlspecialchars($cabinType); ?>"><br><br>
        
        <label for="cabinDescription">Cabin Description:</label><br>
        <textarea id="cabinDescription" name="cabinDescription" rows="4" cols="50"><?php echo htmlspecialchars($cabinDescription); ?></textarea><br><br>
        
        <label for="pricePerNight">Price per Night ($):</label>
        <input type="number" id="pricePerNight" name="pricePerNight" value="<?php echo htmlspecialchars($pricePerNight); ?>"><br><br>
        
        <label for="pricePerWeek">Price per Week ($):</label>
        <input type="number" id="pricePerWeek" name="pricePerWeek" value="<?php echo htmlspecialchars($pricePerWeek); ?>"><br><br>
        
        <label for="photo">Cabin Photo:</label><br>
        <img src="<?php echo htmlspecialchars('../images/' . $photo); ?>" alt="Cabin Photo" width="200"><br>
        <input type="file" id="photo" name="photo"><br><br>
        
        <input type="submit" value="Update">
        
    </form>
</body>
</html>

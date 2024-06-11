<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (isset($_POST["cabinType"]) && isset($_POST["cabinDescription"]) && isset($_POST["pricePerNight"]) && isset($_POST["pricePerWeek"])) {
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "SunnySpot";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare data for insertion
        $cabinType = $_POST["cabinType"];
        $cabinDescription = $_POST["cabinDescription"];
        $pricePerNight = $_POST["pricePerNight"];
        $pricePerWeek = $_POST["pricePerWeek"];

        // Handle file upload
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if a file is uploaded and if it's a valid image
        if (!empty($_FILES["photo"]["name"])) {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
                echo "File is not an image.";
            }
        } else {
            // If no image uploaded, default to "testCabin.jpg"
            $targetFile = "testCabin.png";
        }

        function validatePrices($pricePerNight, $pricePerWeek) {
            if ($pricePerNight <= 0 || $pricePerWeek <= 0) {
                if ($pricePerNight <= 0) {
                    echo "Price per night must be a positive number. <br>";
                }
                if ($pricePerWeek <= 0) {
                    echo "Price per week must be a positive number. <br>";
                }
                return false; // Indicate failure
            }

            if ($pricePerWeek > 5 * $pricePerNight) {
                echo "Price per week cannot be more than 5 times the price per night.";
                return false; // Indicate failure
            }

            return true; // Indicate success
        }

        // Assuming $pricePerNight, $pricePerWeek, and $uploadOk are defined earlier in the script
        if (validatePrices($pricePerNight, $pricePerWeek)) {
            if ($uploadOk == 1) {
                $sql = "INSERT INTO Cabin (cabinType, cabinDescription, pricePerNight, pricePerWeek, photo) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssdds", $cabinType, $cabinDescription, $pricePerNight, $pricePerWeek, $targetFile);
                if ($stmt->execute()) {

                    // Redirect to cabin page with success parameter
                    header("Location: ../allCabins.php?success=new_cabin_added");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "File upload failed.";
            }
        }
        $conn->close();
    } else {
        echo "All fields are required.";
    }
}

?>

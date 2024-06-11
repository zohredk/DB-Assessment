<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Cabin Form</title>
    <link href="https://fonts.googleapis.com/css?family=Quando&display=swap" rel="stylesheet">
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <h1>New Cabin Form</h1>
    <form action="insertCabin.php" method="post" enctype="multipart/form-data">
        <label for="cabinType">Cabin Type:</label>
        <input type="text" id="cabinType" name="cabinType"><br><br>
        
        <label for="cabinDescription">Cabin Description:</label><br>
        <textarea id="cabinDescription" name="cabinDescription" rows="4" cols="50"></textarea><br><br>
        
        <label for="pricePerNight">Price per Night ($):</label>
        <input type="number" id="pricePerNight" name="pricePerNight"><br><br>
        
        <label for="pricePerWeek">Price per Week ($):</label>
        <input type="number" id="pricePerWeek" name="pricePerWeek"><br><br>
        
        <label for="photo">Cabin Photo:</label>
        <input type="file" id="photo" name="photo"><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>

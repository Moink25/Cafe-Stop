<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asher";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["address"]) &&
        isset($_POST["placeName"]) &&
        isset($_FILES["photo"]) &&
        isset($_POST["latitude"]) &&
        isset($_POST["longitude"])
    ) {
        $address = $_POST["address"];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $placeName = $_POST["placeName"];
        $photo = $_FILES["photo"]["name"];

        // Handle file upload
        $targetDir = "uploads/"; // Define the directory to save uploaded photos
        $targetFile = $targetDir . basename($photo);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
            // File uploaded successfully

            // Insert the data into the database using a prepared statement
            $sql = "INSERT INTO register (address, latitude, longitude, placename, photo) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sddss", $address, $latitude, $longitude, $placeName, $targetFile);

            if ($stmt->execute()) {
                echo "Location data successfully stored in the database.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading the photo.";
        }
    }
}

// Close the database connection
$conn->close();
?>

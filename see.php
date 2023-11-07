<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "asher";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $placename = $_POST['placename'];
    
    // SELECT reviews for the specific place based on placename
    $sql = "SELECT * FROM reviews WHERE placename = '$placename'";
    $result = $conn->query($sql);
    
    // Start the HTML structure with Tailwind CSS
    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Reviews for $placename</h1>

        <form action="review.php" method="POST">
            <input type="hidden" value="$placename" name="placename">
            <input class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded" type="submit"
                                value="Give Review" name="submit">
        </form> 
HTML;  

    // Check if there are reviews
    if ($result->num_rows > 0) {
        // Loop through the reviews and display them
        echo '<div class="space-y-4">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="bg-white p-4 rounded shadow-md">';
            echo '<p class="text-lg font-bold">Name: ' . $row['name'] . '</p>';
            echo '<p class="text-gray-600">Place Name: ' . $row['placename'] . '</p>';
            echo '<p class="mt-2">Review: ' . $row['review'] . '</p>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p class="text-gray-600">No reviews found for this place.</p>';
    }

    // End the HTML structure
    echo <<<HTML
    </div>
</body>
</html>
HTML;

    $conn->close();
} else {
    echo "Session variable 'placename' is not set correctly.";
}
?>

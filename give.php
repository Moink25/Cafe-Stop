<?php
session_start();
$address = $_GET['address'];
$latitude = $_GET['latitude'];
$longitude = $_GET['longitude'];

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

// Query the database with the given address, latitude, and longitude
$sql = "SELECT * FROM register WHERE ABS(latitude - $latitude) < 0.025 AND ABS(longitude - $longitude) < 0.025";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location Page</title>
    <!-- Include your head content here -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=Aoua5qyV-S3MRWLdAj6lvgX66bFtOd1XKcbWaPHbSykHK9L7wJztPpDGwVtxz2HM&callback=loadMapScenario' async defer></script>
</head>
<body>
    <!-- Include your header content here -->
    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto text-center">
            <h1 class="text-2xl font-bold">Welcome to Our Location Page</h1>
        </div>
    </header>
    <?php

if ($result->num_rows > 0) {
    // Display the content for the matching location(s)
    while ($row = $result->fetch_assoc()) {
        // $_SESSION['placename'] = $row['placename'];
        ?>
        <section class="text-gray-600 body-font overflow-hidden">
            <div class="container px-5 py-24 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">PROFILE</h2>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Name</span>
                            <span class="ml-auto text-gray-900"><?= $row["placename"] ?></span>
                        </div>
                        <div class="flex border-t border-gray-200 py-2">
                            <span class="text-gray-500">Address</span>
                            <span class="ml-auto text-gray-900"><?= $row["address"] ?></span>
                        </div>
                        <div class="flex">
                            <a href="https://www.google.com/maps/place/<?= $row['latitude'] ?>,<?= $row['longitude'] ?>"
                               class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded mr-6">
                                View on Google Maps
                            </a>
                            <form action="see.php" method="POST">
                               <?php echo "<input type='hidden' value='". $row['placename'] ."' name='placename'>";?>
                              <?php
                              echo '<input
                               class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded" type="submit"
                                value="View Reviews">';?>
                            
                            </form>
                            
                        </div>
                    </div>
                    <img alt="ecommerce" class="lg:w-32 w-48 lg:h-auto h-64 object-cover object-center rounded"
                         src="<?= $row['photo'] ?>">
                </div>
            </div>
        </section>
        <?php
    }
} else {
    echo "Location not found in the database.";
}

$conn->close();
?>
</body>
</html>

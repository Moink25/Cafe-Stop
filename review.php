<?php
session_start();
// Connect to MySQL database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'asher';

$conn = mysqli_connect($host, $username, $password, $database);

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $placename = mysqli_real_escape_string($conn, $_POST['placename']);
   echo '<h2 class="ml-[400px] text-xl">'.$placename.'</h2>';
    ?>
    
    <form action="review_form.php" method="POST" class="max-w-md mx-auto bg-white p-8 rounded shadow-md">
        <input type="hidden" name="placename" value="<?= $placename ?>">
        <div class="mt-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
            <input id="name" name="name" type="text" required
                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none">
        </div>
        <div class="mt-4">
            <label for="review" class="block text-gray-700 text-sm font-bold mb-2">Your Review</label>
            <textarea id="review" name="review" required
                class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none"
                rows="4"></textarea>
        </div>
        <div class="mt-4">
            <button type="submit"
                class="bg-indigo-500 text-white border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Submit</button>
        </div>
    </form>
    <?php
} else {
    echo "<div class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4' role='alert'>";
    echo "<p class='font-bold'>Alert!</p>";
    echo "<p>Passwords don't match.</p>";
    echo "</div>";

   

    mysqli_close($conn);
}
// Close database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>
<body>
    
</body>
</html>

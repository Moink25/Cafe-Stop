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
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $review = mysqli_real_escape_string($conn, $_POST['review']);

    
   
    $sql = "INSERT INTO `reviews` (`name`, `placename`, `review`) VALUES ('$name', '$placename', '$review');";
    // $id = "SELECT * FROM flatmate id";
    if (mysqli_query($conn, $sql)) {
       
       
    
      header("Location: after_login.html");
    } else {
      echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
 else{
   echo "<div class='bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4' role='alert'>";
  echo "<p class='font-bold'>Alert!</p>";
  echo "<p>Passwords don't match.</p>";
echo "</div>";
    
    // header("Location: signup.php");

    mysqli_close($conn);

 }
  

  // Close database 
  
?>
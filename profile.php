<?php
session_start();

if (isset($_SESSION['username'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "asher";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_SESSION['username'];
    $sql = "SELECT * FROM signup WHERE email = '$email'";
    $result = $conn->query($sql);
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
<header>
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                
                <div class="w-full text-gray-700 md:text-center text-2xl font-semibold flex ">
                    <img src="a-letter-logo-png-100.png" alt="" class="w-12">
                   <h2 class="text-12">Asher</h2>
                </div>
                
            </div>
            <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Home</a>
                   
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a> -->
                </div>
            </nav>
           
        </div>
    </header>
    <?php
if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
<section class="text-gray-600 body-font overflow-hidden">
  <div class="container px-5 py-24 mx-auto">
    <div class="lg:w-4/5 mx-auto flex flex-wrap">
      <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0">
        <h2 class="text-sm title-font text-gray-500 tracking-widest">PROFILE</h2>
        <!-- <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">Animated Night Hill Illustrations</h1> -->
       
        
        <div class="flex border-t border-gray-200 py-2">
          <span class="text-gray-500">First Name</span>
          <?php
          echo "<span class='ml-auto text-gray-900'>".$row["first"]."</span>";?>
        </div>
        <div class="flex border-t border-gray-200 py-2">
          <span class="text-gray-500">Last Name</span>
          <?php
          echo "<span class='ml-auto text-gray-900'>".$row["last"]."</span>";?>
        </div>
        <div class="flex border-t border-b mb-6 border-gray-200 py-2">
          <span class="text-gray-500">Email</span>
          <?php
          echo "<span class='ml-auto text-gray-900'>".$email."</span>";?>
        </div>
      
      </div>
      <!-- <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded" src="https://dummyimage.com/400x400"> -->
    </div>
  </div>
</section>
<?php
  }

  $conn->close();
} else {
  header("Location: login.php");
  exit();
}
?>

</body>
</html>
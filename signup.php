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
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
  
  
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cfpassword = mysqli_real_escape_string($conn, $_POST['cfpassword']);
    
    // Insert  into database
   if($password==$cfpassword)
   {
    $sql = "INSERT INTO `signup` (`first`, `last`, `email`, `password`) VALUES ('$first', '$last', '$email', '$password');";
    // $id = "SELECT * FROM flatmate id";
    if (mysqli_query($conn, $sql)) {
       
        echo"<script>
        alert('Signup Successful!');
    </script>";
    
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
    <header>
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <!-- <div class="hidden w-full text-gray-600 md:flex md:items-center">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.2721 10.2721C16.2721 12.4813 14.4813 14.2721 12.2721 14.2721C10.063 14.2721 8.27214 12.4813 8.27214 10.2721C8.27214 8.06298 10.063 6.27212 12.2721 6.27212C14.4813 6.27212 16.2721 8.06298 16.2721 10.2721ZM14.2721 10.2721C14.2721 11.3767 13.3767 12.2721 12.2721 12.2721C11.1676 12.2721 10.2721 11.3767 10.2721 10.2721C10.2721 9.16755 11.1676 8.27212 12.2721 8.27212C13.3767 8.27212 14.2721 9.16755 14.2721 10.2721Z" fill="currentColor" /><path fill-rule="evenodd" clip-rule="evenodd" d="M5.79417 16.5183C2.19424 13.0909 2.05438 7.39409 5.48178 3.79417C8.90918 0.194243 14.6059 0.054383 18.2059 3.48178C21.8058 6.90918 21.9457 12.6059 18.5183 16.2059L12.3124 22.7241L5.79417 16.5183ZM17.0698 14.8268L12.243 19.8965L7.17324 15.0698C4.3733 12.404 4.26452 7.97318 6.93028 5.17324C9.59603 2.3733 14.0268 2.26452 16.8268 4.93028C19.6267 7.59603 19.7355 12.0268 17.0698 14.8268Z" fill="currentColor" />
                    </svg>
                    <span class="mx-1 text-sm">NY</span>
                </div> -->
                <div class="w-full text-gray-700 md:text-center text-2xl font-semibold flex ">
                    <img src="a-letter-logo-png-100.png" alt="" class="w-12 ">
                   <h2 class="text-12">Asher</h2>
                </div>
                <div class="flex items-center justify-end w-full">
                    <button class="flex items-center mt-4 mx-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span><a href="login.php">Login</a></span>
                        
                    </button>
                    <button class="flex items-center mt-4 mx-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span><a href="signup.php">Signup</a></span>
                        
                    </button>

                    
                </div>
            </div>
            <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="index.html">Home</a>
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Categories</a> -->
                    
                   
                </div>
            </nav>
            <div class="relative mt-6 max-w-lg mx-auto">
           
                
            </div>
        </div>
    </header>
    <!-- component -->
<div class="py-6">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
          <div class="hidden lg:block lg:w-1/2 bg-cover" style="background-image:url('https://source.unsplash.com/400x800/?cafe')"></div>
          <div class="w-full p-8 lg:w-1/2">
              <h2 class="text-2xl font-semibold text-gray-700 text-center">Brand</h2>
              <p class="text-xl text-gray-600 text-center">Welcome back!</p>
            
            <form action="#" method="POST"> 
              <div class="mt-4">
                  <label class="block text-gray-700 text-sm font-bold mb-2">First name</label>
                  <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="text" name="first" required>
              </div>
              <div class="mt-4">
                  <div class="flex justify-between">
                      <label class="block text-gray-700 text-sm font-bold mb-2">Last name</label>
                      
                  </div>
                  <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="text" name="last" required>
              </div>
              
              <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email" name="email" required>
            </div>
            
            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" name="password"required>
            </div>
            
            <div class="mt-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                <input class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password" name="cfpassword" required>
            </div>
              <div class="mt-8">
                  <button class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600">
                    <input type="submit" name="submit" id="submit" value="signup">
                  </button>
              </div>
              </form>
              <div class="mt-4 flex items-center justify-between">
                  <span class="border-b w-1/5 md:w-1/4"></span>
                  <h2>Already have an account?</h2>
                  <a href="login.php" class="text-xs text-gray-500 uppercase">Login</a>
                  <span class="border-b w-1/5 md:w-1/4"></span>
              </div>
          </div>
      </div>
  </div>
</body>
</html>
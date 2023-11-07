<!DOCTYPE html>
<html>
<head>
    <title>Location Map</title>
    <script src="https://www.bing.com/api/maps/mapcontrol?callback=loadMapScenario" async defer></script>
    <style>
        #map {
            height: 300px;
            width: 700px;
        }
    </style>
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
                
                <div>
                    <img src="profile.png" alt="" class="w-12 ml-8">
                    <button class="flex items-center mt-4 mx-4 px-3 py-2 bg-blue-600 text-white text-sm uppercase font-medium rounded hover:bg-blue-500 focus:outline-none focus:bg-blue-500">
                        <span><a href="profile.php">Profile</a></span>
                    </button>
                </div>
            </div>
            <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Home</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="register.php">Register</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">Contact</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a>
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a> -->
                </div>
            </nav>


            <div class="relative mt-6 max-w-lg mx-auto">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                    <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
                 <form action="" method="POST">
                <input class="w-full border rounded-md pl-10 pr-4 py-2 focus:border-blue-500 focus:outline-none focus:shadow-outline" type="text" placeholder="Search by location">
            </form>
            </div>
        </div>
</header>

<div class="py-6">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
          <!-- <div class="map"></div> -->
          <div id="map"></div>
          <div class="w-full p-8 lg:w-1/2">
        
          <form id="addressForm" action="insert.php" method="POST" enctype="multipart/form-data">
    <div class="my-4">
        <label for="placeName">Place Name:</label>
        <input type="text" id="placeName" name="placeName" required>
    </div>
    <div class="my-4">
        <label for="photo">Upload Photo:</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
    </div>
    <div class="my-4">
        <label for="address">Enter Your Address:</label>
        <input type="text" id="address" name="address" required>
    </div>
    <button class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-gray-600" type="submit" name="submit" id="submit">Submit</button>
</form>

      </div>
      </div>
    
    <script>
        var map, searchManager;

        function loadMapScenario() {
            map = new Microsoft.Maps.Map(document.getElementById('map'), {
                credentials: 'BINGMAPAPIKEY'
            });

            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                searchManager = new Microsoft.Maps.Search.SearchManager(map);
            });

            document.getElementById('addressForm').addEventListener('submit', geocodeAddress);
        }

        function geocodeAddress(event) {
    event.preventDefault();
    var address = document.getElementById('address').value;

    if (searchManager) {
        searchManager.geocode({
            where: address,
            callback: function (geocodeResult) {
                if (geocodeResult && geocodeResult.results.length > 0) {
                    // Clear the existing entities (pushpins) from the map
                    map.entities.clear();

                    var location = geocodeResult.results[0].location;
                    var pin = new Microsoft.Maps.Pushpin(location, { title: address });
                    map.entities.push(pin);
                    var latitude = location.latitude;
                    var longitude = location.longitude;
                    sendDataToServer(address, latitude, longitude);
                } else {
                    console.log('Address not found.');
                }
            }
        });
    }
}


function sendDataToServer(address, latitude, longitude) {
    var xhr = new XMLHttpRequest();
    var formData = new FormData();
    var photoInput = document.getElementById('photo'); // Get the file input element
    var placeName = document.getElementById('placeName').value; // Get the value of placeName

    formData.append('address', address);
    
    formData.append('latitude', latitude);
    formData.append('longitude', longitude);
    formData.append('placeName', placeName); // Append placeName to formData

    // Check if a file was selected
    if (photoInput.files.length > 0) {
        formData.append('photo', photoInput.files[0]); // Append the file object
    }

    xhr.open('POST', 'insert.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    xhr.send(formData);
}


    </script>
</body>
</html>

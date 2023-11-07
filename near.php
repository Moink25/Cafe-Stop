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
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="after_login.html">Home</a>
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="register.php">Register</a> -->
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="show.php">Contact</a> -->
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="near.php">About</a> -->
                    <!-- <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="#">About</a> -->
                </div>
            </nav>
          
            
          
        </div>
    </header>
<section class="bg-white py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <h1 class="text-2xl font-bold">Location Map</h1>
        </div>
    </section>

<div class="py-6">
    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <div id="map"></div>
        <div class="w-full p-8 lg:w-1/2" id="addressFormContainer">
            <form id="addressForm" action="give.php" method="POST">
                <div class="mt-4">
                    <label for="address">Enter Your Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <button class="bg-gray-700 text-white font-bold py-2 px-4 w-full rounded hover-bg-gray-600">
                    <input type="submit" name="submit" id="submit" value="submit">
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    var map, searchManager;

    function loadMapScenario() {
        map = new Microsoft.Maps.Map(document.getElementById('map'), {
            credentials: 'Aoua5qyV-S3MRWLdAj6lvgX66bFtOd1XKcbWaPHbSykHK9L7wJztPpDGwVtxz2HM'
        });

        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
            searchManager = new Microsoft.Maps.Search.SearchManager(map);
        });

        document.getElementById('addressForm').addEventListener('submit', function (event) {
            event.preventDefault();
            geocodeAddress();
        });
    }

    function geocodeAddress() {
        var address = document.getElementById('address').value;

        if (searchManager) {
            searchManager.geocode({
                where: address,
                callback: function (geocodeResult) {
                    if (geocodeResult && geocodeResult.results.length > 0) {
                        var latitude = geocodeResult.results[0].location.latitude;
                        var longitude = geocodeResult.results[0].location.longitude;
                        sendDataToServer(address, latitude, longitude);

                        // Redirect to the next page
                        window.location.href = 'give.php?address=' + encodeURIComponent(address) + '&latitude=' + latitude + '&longitude=' + longitude;
                    } else {
                        console.log('Address not found.');
                    }
                }
            });
        }
    }

    function sendDataToServer(address, latitude, longitude) {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'give.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send('address=' + encodeURIComponent(address) + '&latitude=' + latitude + '&longitude=' + longitude);
    }
</script>
</body>
</html>





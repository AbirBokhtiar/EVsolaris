<?php
    require_once('../model/userModel.php');

    session_start();

    $station = null;

    if (isset($_GET['station_name'])) {
        $station_name = htmlspecialchars($_GET['station_name']);
        $station = getStationDetails($station_name);
    } else {
        $station_name = 'Unknown';
    }

    $user_id = $_SESSION['user_id'];
    $_SESSION['station_name'] = $station_name;

    $userbookings = getBookingsByUser($user_id);
    // $station_name =$station['st_name'];
    // foreach ($userbookings as $booking) {
    //     $station_name = htmlspecialchars($booking['st_name']);
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" crossorigin="anonymous"></script>
    <title>Layout5</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f7fafc;
        }

        .hh {
            background-color: #227c78;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        .navbarr {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .navbarr div span {
            margin-left: 1rem;
            cursor: pointer;
        }

        .bg-white {
            background-color: white;
        }

        .shadow {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem;
        }

        .text-gray {
            color: gray;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col {
            flex: 1 1 50%;
            padding: 1rem;
        }

        .stationInfo {
            background-color: #f7fafc;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .booknow-btn {
            background-color: #227c78;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            font-size: 0.9rem;
            display: inline-block;
        }

        .booknow-btn:hover {
            background-color: #24504d;
        }

        iframe {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .shadow-lg {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .rounded-lg {
            border-radius: 12px;
        }

        .overflow-x-auto {
            overflow-x: auto;
        }

        .max-w-xs {
            max-width: 320px;
        }

        .p-4 {
            padding: 1rem;
        }

        .bg-gray {
            background-color: #f7fafc;
        }

        button {
            border: none;
            cursor: pointer;
        }

        .image-map-container {
            display: flex;
            gap: 1rem;
            align-items: center;
            justify-content: space-between;
        }

        .image-map-container .image {
            border-radius: 15px;
            /* height: 300px;
            width: 48%; */
            object-fit: cover;
        }

        .image-map-container .map {
            /* width: 48%;
            height: 300px; */
            border: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            /* margin-left: 50px;
            margin-right: 50px; */
        }

        .card-slider {
            display: flex;
            gap: 1rem;
            overflow-x: auto;
            scroll-snap-type: x mandatory;
            padding: 1rem 0;
        }

        .card {
            flex-shrink: 0;
            width: 300px;
            scroll-snap-align: start;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }


        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 1rem;
        }

        .card-content h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .card-content p {
            margin: 0.5rem 0 0;
            font-size: 0.9rem;
            color: #666;
        }

        /* Main Block Styling */
        .nearest-stations-block {
            background-color: #f0f0f0;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 2rem;
            width: 80%;
        }

        /* Header Styling */
        .nearest-stations-block .header {
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
        }

        .nearest-stations-block .header .icon {
            color: #e91e63;
            margin-right: 0.5rem;
        }

        /* Slider Wrapper */
        .slider-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        /* Cards Slider */
        .card-slider {
            display: flex;
            gap: 1rem;
            overflow-x: auto;
            /* scroll-snap-type: x mandatory; */
            padding: 1rem 0;
            scroll-behavior: smooth;
            flex: 1;
        }

        /* Card Styling */
        .card {
            flex-shrink: 0;
            width: 300px;
            scroll-snap-align: start;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 1rem;
        }

        .card-content h3 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .card-content p {
            margin: 0.5rem 0 0;
            font-size: 0.9rem;
            color: #666;
        }

        

        /* Slider Buttons */
        /* .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            z-index: 10;
        } */

        /* .prev-btn {
            left: -1rem;
        }

        .next-btn {
            right: -1rem;
        } */

        /* .slider-btn:hover {
            background-color: rgba(0, 0, 0, 0.7);
        } */


    </style>
    <script>
        function handleFormSubmit(event) {
            var isLoggedIn = <?php echo isset($_COOKIE['status']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                event.preventDefault();
                alert("Please login to book a slot");
                window.location.href = 'login.php';
            }
        }
    </script>
</head>

<body>
    <header class="hh">
        <div class="navbarr">
            <img src="https://placehold.co/100x40" alt="company logo">
            <div>
                <span><a href='../controller/logout.php' style="text-decoration: none; color: white;"> logout </a></span>
                <span>Company</span>
                <span>Products and Solutions</span>
                <span><a href="find_station.php" style="text-decoration: none; color: white;">Find a Station</a></span>
                <span><a href="home.php">home</a></span>
            </div>
        </div>
    </header>

    <nav class="bg-white shadow">
        <div class="container">
            <span class="text-gray"> <a href="#" style="text-decoration: none; color: #666;">Home</a> &raquo; <a href="find_station.php" style="text-decoration: none; color: #666;">EV Charging Stations</a> &raquo; Dhanmondi</span>
        </div>
    </nav>

    <div class="container">
        <div class="image-map-container" style="margin: 1rem">
            <img src="https://ecdn.dhakatribune.net/contents/cache/images/800x450x1/uploads/dten/2022/07/14/2022-07-01t100929z-749715644-rc2o1v963jp7-rtrmadp-3-germany-e-mobility.jpeg" 
                 alt="station image" class="image" style="height: 300px; width: 600px;">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14608.036955462778!2d90.3655622322544!3d23.747049949819317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b33cffc3fb%3A0x4a826f475fd312af!2sDhanmondi%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1735370094977!5m2!1sen!2sbd" 
                class="map" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" style="margin-right: 2rem; height: 300px; width: 500px;">
            </iframe>
        </div>
        

        <div class="row">
            <div style="display: flex; align-items: center; padding: 1rem;">
                <h1><?php echo htmlspecialchars($station['st_name'] ?? 'Station not found'); ?></h1>
            </div>
            <div class="stationInfo" style="margin: 0">
                <h6 style="margin: 0;">
                    <div class="flex items-center" style="font-size: large;">
                        <i class="fas fa-map-marker-alt" style="display: flex; color: #e41111; font-size: large;"></i>
                        <!-- address -->
                        <span style="padding: 0.5rem;">
                        <?php echo htmlspecialchars($station['st_address'] ?? 'Address not available'); ?>
                        </span>
                    </div>
                </h6>

                <div class="row">
                    <div class="flex" style="width: 100%;">
                        <h4><i class="fas fa-bolt" style="margin-right: 8px;"></i>Charging Information</h4>
                    </div>
    
                    <div class="flex" style="gap: 3rem; width: 100%; margin-bottom: 1rem;">
                        <div>
                            <h4>Socket Information</h4>
                            <div>
                                18 Amp Socket
                            </div>
                        </div>
                        <div>
                            <h4>Vehicle Type</h4>
                            <div style="display: flex; gap: 0.5rem; align-items: center; margin-top: 12px;">
                                <i class="fas fa-car" style="margin-right: 8px;"></i>
                                <i class="fas fa-bicycle" style="margin-right: 8px;"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- <div class="col">
                <h4><i class="fas fa-bolt"></i> Charging Information</h4>
                <div>
                    <h6>Socket Information</h6>
                    <p>18 Amp Socket</p>
                </div>
                <div>
                    <h6>Vehicle Type</h6>
                    <p><i class="fas fa-car"></i> <i class="fas fa-bicycle"></i></p>
                </div>
            </div> -->

        </div>
    </div>

    <div class="stationInfo" style="margin: 0">
        <div class="row">
            <div style="padding: 1rem; margin-left: 1rem;">
                <h2>Slot Booking</h2>
                <form action="payment1.php" method="post" onsubmit="handleFormSubmit(event)">
                    <input type="hidden" name="station_name" value="<?php echo htmlspecialchars($station['st_name'] ?? ''); ?>">
                    <input type="hidden" name="station_address" value="<?php echo htmlspecialchars($station['st_address'] ?? ''); ?>">
                    <input type="hidden" name="station_price" value="<?php echo htmlspecialchars($station['st_price'] ?? ''); ?>">
                    <input type="hidden" name="station_city" value="<?php echo htmlspecialchars($station['city'] ?? ''); ?>">

                    <label for="slot">Pick an Available Slot for the Station:</label><br><br>
                    <select id="slot" name="slot">
                        <option value="10-12">10:00 AM - 12:00 PM</option>
                        <option value="12-2">12:00 PM - 2:00 PM</option>
                        <option value="2-4">2:00 PM - 4:00 PM</option>
                    </select>
                    <button type="submit" class="booknow-btn" style="margin-top: 1rem;">Book Right Now</button>
                </form>
            </div>

            <div style="padding: 1rem; margin-left: 150px;">
                <h2>Existing Reservation Details</h2>
                <p><strong>Station:</strong> Station A</p>
                <p><strong>Slot:</strong> 10:00 AM - 12:00 PM</p>
                <p><strong>Status:</strong> Confirmed</p>
                <a href="#" class="booknow-btn">Cancel Booking</a>
            </div>
        </div>
    </div>

    <div class="nearest-stations-block">
        <div class="header">
            <i class="fas fa-battery-full icon"></i>
            <span>Nearest EV Charging Stations</span>
        </div>
        <div class="slider-wrapper">
            <!-- <button class="slider-btn prev-btn" onclick="scrollLeft()">&#10094;</button> -->
            <div class="card-slider">
                <div class="card">
                    <img src="https://media.licdn.com/dms/image/v2/D5612AQEHpRlcrC_3Tw/article-cover_image-shrink_720_1280/article-cover_image-shrink_720_1280/0/1678548172261?e=1741219200&v=beta&t=3abq-jdxjoUCs9KcPsyxcH_SLpU5fnoXGz_lv1ehl0o" alt="EV charging station">
                    <div class="card-content">
                        <h3>Shimanto 5</h3>
                        <p>7/a Dhanmondi, Dhaka - 1206</p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://tds-images.thedailystar.net/sites/default/files/styles/big_202/public/images/2023/08/17/dhaka-first-ev-charging-station.jpg" alt="EV charging station">
                    <div class="card-content">
                        <h3>Shimanto 2</h3>
                        <p>5/a Dhanmondi, Dhaka - 1207</p>
                    </div>
                </div>
                <div class="card">
                    <img src="https://www.techjuice.pk/wp-content/uploads/2022/11/ev-charging-940x705.jpg" alt="EV charging station">
                    <div class="card-content">
                        <h3>Shimanto 3</h3>
                        <p>15/a Dhanmondi, Dhaka - 1208</p>
                    </div>
                </div>
            </div>
            <!-- <button class="slider-btn next-btn" onclick="scrollRight()">&#10095;</button> -->
        </div>
    </div>
    
    
</body>
</html>

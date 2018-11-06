<?php
include 'database/dbConfig.php';

$query = $db->query("SELECT * FROM countries WHERE id =" . $_POST['countryName'] . '');

$query1 = $db->query("SELECT * FROM counties WHERE id =" . $_POST['stateName'] . '');
$query2 = $db->query("SELECT * FROM towns WHERE townID =" . $_POST['townName'] . '');
$rowCount = $query->num_rows;

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$street1 = $_POST['street1'];
$street2 = $_POST['street2'];
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3GNUNqilg3CdYIedKxEY5zgCl4p7xp-4"></script>
        <link href="css/CCcss.css" rel="stylesheet" type="text/css"/>

        <style>
            #mapDiv 
            {
                width:100%;
                height:600px;
                border:thin solid #CCC;
            }

            #controlPanel
            {
                position: absolute;
                top: 50px;
                left: 10px;
                z-index: 2;
                background-color: #fff;
                padding: 5px;
                border: 1px solid #999;
            }

            #directions
            {
                float:left;
                width:100%;
                margin:0px;
            }
        </style>



        <script>

            var currentLocationMap;
            var directionsDisplay;
            var directionsService;
            var currentLocationMap;

            window.onload = onAllAssetsLoaded;
            document.write("<div id='loadingMessage'>Loading...</div>");
            function onAllAssetsLoaded()
            {
                // hide the webpage loading message
                document.getElementById('loadingMessage').style.visibility = "hidden";

                displayMap();
                calculateRoute();
            }


            function displayMap()
            {
                directionsService = new google.maps.DirectionsService();
                // route planner
                directionsDisplay = new google.maps.DirectionsRenderer();
                var currentLocationMap = new google.maps.LatLng(54, -6.3);  // DkIT

                var mapOptions = {zoom: 10, center: currentLocationMap};
                currentLocationMap = new google.maps.Map(document.getElementById('mapDiv'), mapOptions);
                directionsDisplay.setMap(currentLocationMap);
            }





            function calculateRoute()
            {
                var country = document.getElementById('mapCountry').innerHTML;
                var county = document.getElementById('mapCounty').innerHTML;
                var town = document.getElementById('mapTown').innerHTML;

                var start = "DKIT Dundalk Ireland";
                var end = town + county + country;

                var request = {origin: start,
                    destination: end,
                    travelMode: google.maps.TravelMode.DRIVING};


                directionsService.route(request, function (response, status)
                {
                    if (status == google.maps.DirectionsStatus.OK)
                    {
                        directionsDisplay.setDirections(response);
                    }
                });
            }


        </script>
    </head>


    <header>
        <?php include 'includes/header.php'; ?>
    </header>

    <body>

        <table>
            <tr>
                <td>
                    First Name <br>   
                </td>
                <td>
                    <?php echo $firstname; ?>  
                </td>
            </tr>
            <tr>
                <td>
                    Second Name  
                </td>
                <td>
                    <?php echo $lastname; ?>   
                </td>
            </tr>
            <tr>
                <td>
                    Street 1  
                </td>
                <td>
                    <?php echo $street1; ?>   
                </td>
            </tr>
            <tr>
                <td>
                    Street 2    
                </td>
                <td>
                    <?php echo $street2; ?>   
                </td>
            </tr>

            <tr>
                <td>
                    Country   
                </td>
                <td>
                    <?php
                    if ($rowCount > 0) {
                        while ($row = $query->fetch_assoc()) {
                            echo '<p id="mapCountry" onclick="calculateRoute(this)" >' . $row['country'] . '</p>';
                        }
                    } elseif (empty($rowCount)) {
                        echo '<p id="mapCountry" onclick="calculateRoute(this)">No Country Selected</p>';
                    }
                    ?>
                </td>
            </tr>


            <tr>
                <td>
                    County   
                </td>
                <td>
                    <?php
                    if ($rowCount > 0) {
                        while ($row = $query1->fetch_assoc()) {
                            echo '<p id="mapCounty" onclick="calculateRoute(this)">' . $row['name'] . '</p>';
                        }
                    } elseif (empty($rowCount)) {
                        echo '<p id="mapCounty" onclick="calculateRoute(this)">No County Selected</p>';
                    }
                    ?>
                </td>
            </tr>



            <tr>
                <td>
                    Town   
                </td>
                <td>
                    <?php
                    if ($rowCount > 0) {
                        while ($row = $query2->fetch_assoc()) {
                            echo '<p id="mapTown" onclick="calculateRoute(this)">' . $row['townName'] . '</p>';
                        }
                    } elseif (empty($rowCount)) {
                        echo '<p id="mapTown" onclick="calculateRoute(this)">No Town Selected</p>';
                    }
                    ?>

                </td>
            </tr>


        </table>

        <form action="index.php">
        <button class="preview" onclick="" >ReEnter Address</button>
        </form>
        <div id="mapDiv">


        </div>
    </body>

</html>
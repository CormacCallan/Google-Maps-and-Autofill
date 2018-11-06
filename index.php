<html>

    <head>
        <title>Ajax CA3</title>

        <link href="css/CCcss.css" rel="stylesheet" type="text/css"/>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="script.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3GNUNqilg3CdYIedKxEY5zgCl4p7xp-4"></script>

   
    </head>
    <?php
    include 'includes/header.php';
    ?>


    <body>
        <div id="container">


            <?php
            include 'database/dbConfig.php';
            $query = $db->query("SELECT * FROM countries ORDER BY country ASC");
            $rowCount = $query->num_rows;
            ?>

     

         <span id="demo"></span> 
            <div id="formConatin">
                <form action="action_page_1.php" method="POST">

                    <label>First Name : </label>
                    <input type="text" id="fname" name="firstname" placeholder="Your name.."><br>

                    <label>Second Name : </label>
                    <input type="text" id="lname" name="lastname" placeholder="Your last name.."><br>

                    <label>Street Line 1 : </label>
                    <input type="text" id="street1" name="street1" placeholder="Street Line 1.."><br>

                    <label>Street Line 2 : </label>
                    <input type="text" id="street2" name="street2" placeholder="Street Line 2.."><br>


                    <!-- While there is something in the row echo the country_id and countryName. -->
                    <label>Country : </label>
                    <select id="country" name="countryName">
                        <option value="">Select Country</option>
                        <?php
                        if ($rowCount > 0) {
                            while ($row = $query->fetch_assoc()) {
                                echo '<option  value="' . $row['id'] . '">' . $row['country'] . '</option>';
                            }
                        } else {
                            echo '<option value="">Country not available</option>';
                        }
                        ?>
                    </select>

                    <div id="hideAjax">

                        <label>State : </label>
                        <select id="state" name="stateName">
                            <option value="">Select country first</option>
                        </select>
                        <label>Town : </label>
                        <select id="city" name="townName">
                            <option value="">Select state first</option>
                        </select>
                  
                        <input id="submit" type="submit" value="Send"><br>
                      
                        </form>
                
                    
                    </div>

               



            </div>


        </div>

        <div id="mapDiv">

     
        </div>


    </body>
    
    <footer id="footer">
        
    </footer>
    
 

</html>
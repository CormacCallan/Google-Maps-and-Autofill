<?php
//Include the database configuration file
include 'database/dbConfig.php';

if(!empty($_POST["country_id"])){
    //Fetch all state data
    $query = $db->query("SELECT * FROM counties WHERE country_id = ".$_POST['country_id']." ORDER BY name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = $query->fetch_assoc()){
            
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }else{
        echo '<option value="">County not available</option>';
    }
}

elseif(!empty($_POST["countyID"])){
    //Fetch all city data
    $query = $db->query("SELECT * FROM towns WHERE countyID = ".$_POST['countyID']." ORDER BY townName ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //City option list
    if($rowCount > 0){
        echo '<option value="">Select town</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['townID'].'">'.$row['townName'].'</option>';
        }
    }else{
        echo '<option value="">Town not available</option>';
    }
}




?>
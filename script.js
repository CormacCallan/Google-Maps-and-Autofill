

$(document).ready(function(){
    

    $("#mapDiv").hide();
    $("#hideAjax").hide();
    $("#previewButton").hide();
    
    $("form").hide();
    $("form").slideDown(1500);
    
    
    $("#previewButton").click(function(){
        $("#mapDiv").fadeToggle(2000);
    });
    



    $('#country').on('change',function(){
        $("#hideAjax").slideDown(1000);
        $("#previewButton").fadeIn(1500);
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select county first</option>'); 
        }
    });
    
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'countyID='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    

    
    
       
});




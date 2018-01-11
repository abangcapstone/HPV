$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(ev){
          ev.preventDefault();
           //var client_code = $(this).attr("id");
  var client_code = $(this).data("id");
  
           $.ajax({  
                url:"../ADMIN/update_data/fetch-client.php",  
                method:"POST",  
                data:{client_code:client_code},  
                //dataType:"json",  
                success:function(data){  

                  $('#Result').html(data);
                  $('#UpdateClientModal').modal('show');
                  

                  
                }  
           });  
       });
  
 
    
    
    
  
   
});

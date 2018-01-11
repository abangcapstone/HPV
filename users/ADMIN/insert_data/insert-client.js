$(document).ready(function () {
 $('#CreateClientForm').on("submit",function(event) {  
  event.preventDefault();  
     
    
   $.ajax({  
    url:"../ADMIN/insert_data/insert-client.php",  
    method:"POST",  
    data:$('#CreateClientForm').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
     $('#CreateClientForm')[0].reset();  
     $('#SuccessDiv').show();
     $('#ErrorDiv').hide();
     $("#Message").text("Data Inserted"); 
    
                setTimeout(function(){
                   location.reload(); 
                }, 500);
        
    },
      error:function(data){
        $('#ErrorDiv').show();
        $("#ERRMessage").text("Client Already Exist");
          setTimeout(function() {
              $('#ErrorDiv').fadeOut('fast');
          }, 1000)
    }
   });  
   
 });
});
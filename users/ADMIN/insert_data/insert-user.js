$(document).ready(function() {
 $('#CreateUserForm').on("submit", function(event) {  
  event.preventDefault();  
      
    
   $.ajax({  
    url:"../ADMIN/insert_data/insert-user.php",  
    method:"POST",  
    data:$('#CreateUserForm').serialize(),  
    beforeSend:function(){  
     $('#create').val("Inserting");  
    },
    success:function(data){  
     $('#CreateUserForm')[0].reset();  
     $('#SuccessDiv').show();
     $('#ErrorDiv').hide();
     $("#Message").text("Data Inserted"); 
    
                setTimeout(function(){
                   location.reload(); 
                }, 500);
        
    },
     error:function(data){
        $('#ErrorDiv').show();
        $("#ERRMessage").text("Username Already Exist");
         setTimeout(function() {
             $('#ErrorDiv').fadeOut('fast');
         }, 1000)
    }
   });  
   
 });
});
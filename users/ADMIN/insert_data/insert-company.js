$(document).ready(function () {
 $('#CreateCompanyForm').on("submit",function(event) {  
  event.preventDefault();  
     
    
   $.ajax({  
    url:"../ADMIN/insert_data/insert-company.php",  
    method:"POST",  
    data:$('#CreateCompanyForm').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
     $('#CreateCompanyForm')[0].reset();
     $('#SuccessDiv').show();
     $('#ErrorDiv').hide();
     $("#Message").text("Data Inserted"); 
    
                setTimeout(function(){
                   location.reload(); 
                }, 500);
                    
   },
    error:function(data){
        $('#ErrorDiv').show();
        $("#ERRMessage").text("Company Already Exist");
        setTimeout(function() {
            $('#ErrorDiv').fadeOut('fast');
        }, 1000)
    }
    
   });  
   
 });
});





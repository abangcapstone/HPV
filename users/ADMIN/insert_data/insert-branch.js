$(document).ready(function () {
 $('#CreateBranchForm').on("submit",function(event) {  
  event.preventDefault();  
     
    
   $.ajax({  
    url:"../ADMIN/insert_data/insert-branch.php",  
    method:"POST",  
    data:$('#CreateBranchForm').serialize(),  
    beforeSend:function(){  
     $('#insert').val("Inserting");  
    },  
    success:function(data){  
     $('#CreateBranchForm')[0].reset();  
     $('#SuccessDiv').show();
     $('#ErrorDiv').hide();
     $("#Message").text("Data Inserted"); 
    
                setTimeout(function(){
                   location.reload(); 
                }, 500);  
    
        
    },
      error:function(data){
        $('#ErrorDiv').show();
        $("#ERRMessage").text("Branch already exist");
          setTimeout(function() {
              $('#ErrorDiv').fadeOut('fast');
          }, 1000)
      }
   });  
   
 });
});
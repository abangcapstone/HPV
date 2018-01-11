$(document).ready(function() {
 $('#CreateCategoryForm').on("submit", function(event) {  
  event.preventDefault();  
   
   
   $.ajax({  
    url:"../ADMIN/insert_data/insert-category.php",  
    method:"POST",  
    data:$('#CreateCategoryForm').serialize(),  
    beforeSend:function(){  
     $('#create').val("Inserting");  
    },    
    success:function(data){  
     $('#CreateCategoryForm')[0].reset();  
     $('#SuccessDiv').show();
     $('#ErrorDiv').hide();
     $("#Message").text("Data Inserted"); 
    
                setTimeout(function(){
                   location.reload(); 
                }, 500);
        
    },
      error:function(data){
        $('#ErrorDiv').show();
        $("#ERRMessage").text("Category Already Exist");
          setTimeout(function() {
              $('#ErrorDiv').fadeOut('fast');
          }, 1000)
      }
       
   });  
   
 });
});
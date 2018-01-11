 
$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(){
          var category_code = $(this).attr("id");  
           $.ajax({  
                url:"../ADMIN/update_data/fetch-category.php",  
                method:"POST",  
                data:{category_code:category_code},  
                dataType:"json",  
                success:function(data){  
                     $('#Category_Code').val(data.categorycode);
                     $('#update_catname').val(data.categoryname);  
                     $('#id_holder').val(data.id);
                     $('#UpdateCategoryModal').modal('show');
               
                }  
           });  
       });
    
    
    $('#UpdateCategoryForm').on("submit",function(event) {  
  event.preventDefault();  
     
    
   $.ajax({  
    url:"../ADMIN/update_data/update-category.php",  
    method:"POST",  
    data:$('#UpdateCategoryForm').serialize(),  
    beforeSend:function(){  
     $('#update').val("Inserting");  
    },  
    success:function(data){     
     $("#UpdateDiv").show(); 
     $("#UpdateMessage").text("Data Updated");
    
                setTimeout(function(){
                   location.reload();
                }, 500);
    
   },
   
    
   });  
   
 });
    
    
});
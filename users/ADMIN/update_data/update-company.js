 
$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(){
          var company_code = $(this).attr("id");  
           $.ajax({  
                url:"../ADMIN/update_data/fetch-company.php",  
                method:"POST",  
                data:{company_code:company_code},  
                dataType:"json",  
                success:function(data){  
                     $('#Comp_Code').val(data.compno);
                     $('#update_compname').val(data.compname);
                     $('#id_holder').val(data.id);
                     $('#update_status').val(data.compstatus);
                     $('#UpdateCompanyModal').modal('show');
               
                }  
           });  
       });
    
    
    $('#UpdateCompanyForm').on("submit",function(event) {  
  event.preventDefault();  
     
    
   $.ajax({  
    url:"../ADMIN/update_data/update-company.php",  
    method:"POST",  
    data:$('#UpdateCompanyForm').serialize(),  
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
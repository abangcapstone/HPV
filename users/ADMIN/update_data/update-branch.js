 
$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(){
          var branch_code = $(this).attr("id");  
           $.ajax({  
                url:"../ADMIN/update_data/fetch-branch.php",  
                method:"POST",  
                data:{branch_code:branch_code},  
                dataType:"json",  
                success:function(data){  
                     $('#branchcode').val(data.branchcode);
                     $('#update_branchloc').val(data.branchloc);  
                     $('#update_branchaddr').val(data.branchaddr);  
                     $('#update_branchemail').val(data.branchemail);  
                     $('#update_branchtelno').val(data.branchtelno);
                     $('#update_branchfaxno').val(data.branchfaxno);   
                     $('#id_holder').val(data.id);
                     $('#update_branchstatus').val(data.branchstatus);
                     $('#UpdateBranchModal').modal('show');
               
                }  
           });  
       });
    
    
    $('#UpdateBranchForm').on("submit",function(event) {  
  event.preventDefault();  
     
    
   $.ajax({  
    url:"../ADMIN/update_data/update-branch.php",  
    method:"POST",  
    data:$('#UpdateBranchForm').serialize(),  
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
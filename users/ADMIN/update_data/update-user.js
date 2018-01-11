$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(ev){
         ev.preventDefault();
          var employee_code = $(this).data("id");
           $.ajax({  
                url:"../ADMIN/update_data/fetch-user.php",  
                method:"POST",  
                data:{employee_code:employee_code},
                success:function(data){

                     $('#Result').html(data);
                     $('#UpdateUserModal').modal('show');
               
                }  
           });  
       });

});
$(document).ready(function(){
  $('#ChangePasswordModal1').modal({
    backdrop: 'static',
    keyboard: false 
  })
  $('#ChangePasswordModal1').modal('show');
/*  $(document).on('click', '.edit_data', function(){
           var employee_code = $(this).attr("id");  
           $.ajax({  
                url:"../ACCOUNTING/update_data/fetch-user.php",  
                method:"POST",  
                data:{employee_code:employee_code},  
                dataType:"json",  
                success:function(data){  
                     $('#id_holder').val(data.id); 
                     
                }  
           });
        });  */
$('#ChangePasswordForm1').on("submit",function(event) {
       event.preventDefault();

   $.ajax({  
    url:"../../update-pass_karaan.php",
    method:"POST",  
    data:$('#ChangePasswordForm1').serialize(),
       success:function(data) {
          /* $("#UpdateDiv").show();
           $("#UpdateMessage").text("Successfully Changed");*/
           setTimeout(function(){
               location.reload();
           }, 500);
       }
   });  
   
 });
});
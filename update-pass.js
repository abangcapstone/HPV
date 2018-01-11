
$('#ChangePasswordForm').on("submit",function(event) {  
       event.preventDefault();

   $.ajax({

    url:"../../update-pass.php",
    method:"POST",  
    data:$('#ChangePasswordForm').serialize(),
    success:function(data){
     $('#ChangePasswordForm')[0].reset();
     $('#message').hide();
        $('#Notification').removeClass("alert alert-danger");
        $('#Notification').addClass("alert alert-success");
        $('#Notification').show();
        $("#Message").text(" Password Changed");
        setTimeout(function() {
            $('#Notification').fadeOut('fast');
        }, 1000)

    },
       error:function(data){
           $('#Notification').removeClass("alert alert-success");
           $('#Notification').addClass("alert alert-danger");
           $('#Notification').show();
           $("#Message").text("Incorrect Old Password").css('color', 'white');
           setTimeout(function() {
               $('#Notification').fadeOut('fast');
           }, 1000)

       }
   });  
   
 });

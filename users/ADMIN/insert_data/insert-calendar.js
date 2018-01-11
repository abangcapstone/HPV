$(document).ready(function() {
    $('#AddHolidayForm').on("submit", function(event) {
        event.preventDefault();


        $.ajax({
            url:"../ADMIN/insert_data/insert-calendar.php",
            method:"POST",
            data:$('#AddHolidayForm').serialize(),
            success:function(data){
                $('#AddHolidayForm')[0].reset();
                $('#SuccessDiv').show();
                $('#ErrorDiv').hide();
                $("#Message").text("Data Inserted");

                setTimeout(function(){
                    location.reload();
                }, 500);

            },
            error:function(data){
                $('#ErrorDiv').show();
                $("#ERRMessage").text("Holiday already exist");

                setTimeout(function() {
                    $('#ErrorDiv').fadeOut('fast');
                }, 1000);

            }
        });

    });
});
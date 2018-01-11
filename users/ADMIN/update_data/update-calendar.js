
$(document).ready(function(){
    $(document).on('click', '.edit_data', function(){
        var ID = $(this).attr("id");
        $.ajax({
            url:"../ADMIN/update_data/fetch-calendar.php",
            method:"POST",
            data:{ID:ID},
            dataType:"json",
            success:function(data){

                $('#updateMonth').val(data.holidayMonth);
                $('#updateDay').val(data.holidayDay);
                $('#updateOccName').val(data.holidayname);
                $('#id_holder').val(data.id);
                $('#update_calendarstatus').val(data.holidaystatus);
                $('#UpdateCalendarModal').modal('show');

            }
        });
    });


    $('#UpdateCalendarForm').on("submit",function(event) {
        event.preventDefault();


        $.ajax({
            url:"../ADMIN/update_data/update-calendar.php",
            method:"POST",
            data:$('#UpdateCalendarForm').serialize(),
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
            error:function(data){
                $('#UpdateErrorDiv').show();
                $("#UpdateERRMessage").text("Invalid Day");
                setTimeout(function () {
                    $('#UpdateErrorDiv').fadeOut('fast');
                }, 1000)


            }

            });

    });


});
$(document).ready(function(){
    $(document).on('click', '.edit_data', function(ev){
        ev.preventDefault();
        var br_number = $(this).data("id");
        alert();
        $.ajax({
            url:"../Accounting/update_data/view-br.php",
            method:"POST",
            data:{br_number:br_number},

            success:function(data){
                $('#Result').html(data);

            }
        });
    });

});

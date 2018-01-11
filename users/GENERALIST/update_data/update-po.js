$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(ev){
          ev.preventDefault();

    let po_number = $(this).data("id");
           $.ajax({  
                url:"../GENERALIST/update_data/update-po.php",
                method:"POST",  
                data:{po_number:po_number},  
                //dataType:"json",  
                success:function(data){
                     $('#Result').html(data);

                }  
           });  
       });
  
 
    
    
    
  
   
});

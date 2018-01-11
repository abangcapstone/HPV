$(document).ready(function(){ 
$(document).on('click', '.edit_data', function(ev){
          ev.preventDefault();

           //var client_code = $(this).attr("id");
    let po_number = $(this).data("id");

           $.ajax({  
                url:"../Accounting/update_data/view-po.php",
                method:"POST",  
                data:{po_number:po_number},  
                //dataType:"json",  
                success:function(data){  
                     /*$('#Client_Code').val(data.clientcode);
                     $('#update_clientcategory').val(data.clientcategory);  
                     $('#update_clientbusiness').val(data.clientbusiness);  
                     $('#update_clientCompName').val(data.clientname);  
                     $('#update_clientCompBranch').val(data.clientbranch);
                     $('#update_clientCompAddr').val(data.clientaddr);
                     $('#update_clientCompEmail').val(data.clientemail);
                     $('#update_clientCompTel').val(data.clienttelno);
                     $('#update_clientCompFax').val(data.clientfaxno);
                     $('#update_clientTerms').val(data.clientterms);
                     $('#update_status').val(data.clientstatus);
                     $('#id_holder').val(data.id);
                     $('#UpdateClientModal').modal('show');*/
                  $('#Result').html(data);
                
                  
                  //$('#UpdateClientModal').modal('show');
                  
                }  
           });  
       });
  
 
    
    
    
  
   
});


$(document).ready(function(){
    $(document).on('click', '#payment', function(ev){
        ev.preventDefault();

        var po_code = $(this).data("id");

        $.ajax({
            url:"../ACCOUNTING/update_data/view-popayment.php",
            method:"POST",
            data:{po_code : po_code},
            success:function(data){
                $('#Result2').html(data);
            }
        });
    });
});

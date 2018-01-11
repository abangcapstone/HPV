$("#avatar-2").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        showBrowse: false,
        browseOnZoneClick: true,
        removeLabel: '',
        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-2',
        msgErrorClass: 'alert alert-block alert-danger',
        defaultPreviewContent: '<img class="img-circle" src="../production/images/clicktochange-avatar.jpg" alt="Your Avatar" height="170px" >',
        layoutTemplates: {main2: '{preview} ' + ' {remove}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
        });
    
    
                var form = $(this);
                var formData = new FormData($(this)[0]);
 
                $.ajax({
                    url: "../users/ADMIN/insert_data/insert-user.php",
                    method: "POST",
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    async: false,
                    success:function(response) {
                        if(response.success == true) {
                          
 
                            $('input[type="text"]').val('');
                            $(".fileinput-remove-button").click();
                        }
                      
                    }
                });
 
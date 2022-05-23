
    
    $(document).ready(function() {
        $('#insert').click(function() {
            var image_name = $('#image').val();
            
            if (image_name == '') {
                alert("resim seçiniz");
                return false;
            } else {
                var extesion = $('#image').val().split('.').pop().toLowerCase();
                if (jQuery.inArray(extesion,['png', 'jpg','jpeg']) == -1) {
                    alert('Resim Dosyası Yukleyınız');
                    $('#image').val('');
                    return false;
                }
            }
        });

    });

 
 

  

 

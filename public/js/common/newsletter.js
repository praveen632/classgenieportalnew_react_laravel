    $(function() {
                $("#form_data").on("submit", function(event) {
                      event.preventDefault();
                    $.ajax({                       
                        url: "newsletter",
                        type: "get",
                        data: $(this).serialize(),
                        success: function(response) {
                           alert(response.success_msg);

                        }
                    });
                });
            }); 

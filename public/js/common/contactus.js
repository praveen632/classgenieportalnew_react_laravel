   $(function() {
                $("#contact_us").on("submit", function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "contactus",
                        type: "get",
                        data: $(this).serialize(),
                        success: function(response) {
                           alert(response.success_msg);

                        }
                    });
                });
            }); 

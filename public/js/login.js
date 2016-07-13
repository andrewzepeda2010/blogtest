// Contact Form Scripts

$(function() {

    $("#loginForm input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var email_address = $("input#email_address").val();
            var cpassword = $("input#cpassword").val();


            $.ajax({
                url: "/login",
                type: "POST",
                data: {
                    email_address: email_address,
                    cpassword: cpassword
                },
                cache: false,
                success: function(response) {
					console.log(response);

					if (response != 0) {
						window.location.href = "/users";
						return;
					}
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry it seems that server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#loginForm').trigger("reset");
                },
            });
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#email_address').focus(function() {
    $('#success').html('');
});

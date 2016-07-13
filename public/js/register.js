// Contact Form Scripts

$(function() {

    $("#registrationForm input").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var username = $("input#username").val();
            var email_address = $("input#email_address").val();
            var cpassword = $("input#cpassword").val();
            var vpassword = $("input#vpassword").val();
            var first_name = $("input#first_name").val();
			var last_name = $("input#last_name").val();
			
			

            $.ajax({
                url: "/register",
                type: "POST",
                data: {
                    username: username,
                    email_address: email_address,
                    cpassword: cpassword,
                    vpassword: vpassword,
					first_name: first_name,
					last_name: last_name
                },
                cache: false,
                success: function(response) {
					console.log(JSON.stringify(response));
					
                    // Success message
                    $('#success').html("<div class='alert alert-success'>");
                    $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-success')
                        .append("<strong>You have successfully registered. </strong>");
                    $('#success > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#registrationForm').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success').html("<div class='alert alert-danger'>");
                    $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success > .alert-danger').append("<strong>Sorry " + first_name + ", it seems that server is not responding. Please try again later!");
                    $('#success > .alert-danger').append('</div>');
                    //clear all fields
                    $('#registrationForm').trigger("reset");
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
$('#username').focus(function() {
    $('#success').html('');
});

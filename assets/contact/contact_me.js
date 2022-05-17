$(function() {
    $("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
        preventSubmit: true,

        submitError: function($form, event, errors) {

        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM

            var thisForm = event.target.getAttribute('id');

            var name = $('#' + thisForm).find("input.name-input").val();
            var email = $('#' + thisForm).find("input.email-input").val();
            var message = $('#' + thisForm).find("input.textarea").val();
            var date = $('#' + thisForm).find("input.date-input").val();
            var time = $('#' + thisForm).find("input.time-input").val();

            $.ajax({
                url: "././mail/contact_me.php",
                type: "POST",
                dataType: 'json',
                data: {
                    name: name,
                    email: email,
                    message: message,
                    date: date,
                    time: time
                },
                cache: false,
                success: function(data) {
                    if(data.error){
	                    console.log('error');
                    }
                    else if(data.success){
                        $('#' + thisForm).trigger("reset");

                        console.log('send');
					}
                }
            });

        },
        filter: function() {
            return $(this).is(":visible");
        }
    });
});
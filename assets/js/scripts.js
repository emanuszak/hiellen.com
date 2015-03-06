$("a[href^='http://']").attr("target","_blank");


// Hide and Reveal Contact Form

$("#contactform form").hide();
$("#contactform").append("<button>Contact Me</button>");
$("button").addClass("contactme").click(function(){
	$(this).prev().show();
	$("#contactform > button").hide();
});

$("button[type=reset]").click(function(){
	$("#contactform form").hide();
	$("#contactform > button").show();
});


//Contact Form

$(function() {

	// Get the form.
	var form = $('#contact');

	// Get the messages div.
	var formMessages = $('#form-messages');

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');

			// Set the message text.
			$(formMessages).text(response);

			// Clear the form.
			$('#name').val('');
			$('#email').val('');
			$('#website').val('');
			$('#message').val('');
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');

			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! An error occurred and your message could not be sent.');
			}
		});

	});

});

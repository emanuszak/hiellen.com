$().ready(function() {


$("a[href^='http://']").attr("target","_blank");



//Contact Form Modal

/*
function openForm(event) {
    $('.contact-wrapper').addClass('full-screen');
    if ($(event.target).is('.form-reset')) {
        $('.contact-wrapper').removeClass('full-screen');
    }
}
*/

$('body').on('click','.open-intake-form', function() {
    $('.contact-wrapper').addClass('full-screen');
    $('.contact-wrapper').load('collaborate.html .intake-form-wrapper');
});


$('.contact-wrapper').on('click','.form-reset', function(){
    $('.contact-wrapper').removeClass('full-screen');
    $('.contact-wrapper').load('index.html .contact-wrapper-inner');
});



/*Auto resize textarea via stephanwagner.me/auto-resizing-textarea */
jQuery.each(jQuery('textarea[data-autoresize]'), function() {
    var offset = this.offsetHeight - this.clientHeight;
 
    var resizeTextarea = function(el) {
        jQuery(el).css('height', 'auto').css('height', el.scrollHeight + offset);
    };
    jQuery(this).on('keyup input', function() { resizeTextarea(this); }).removeAttr('data-autoresize');
});
	
	
//Form submit via Ajax
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
		$('#message').val('');
		
		$('.contact-form-wrapper').removeClass('full-screen');
		
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

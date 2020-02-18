$().ready(function() {
    
/*
    var date = moment().format('YYYY');
    document.getElementById('year-today').innerHTML = date;
*/
    
    $("a[href^='http://']").attr("target","_blank");
    
    // Leads contact form Ajax
    $('#lead_contact').submit(function(e) {
	  e.preventDefault();
	  var $form = $(this);
	  $.post($form.attr("action"), $form.serialize()).then(function(data) {
		   console.log(data);
		});
	});
    
});

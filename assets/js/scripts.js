$("a[href^='http://']").attr("target","_blank");

// Hide and Reveal Contact Form

$(".contactform form").hide();
$(".contactform").append("<button>Contact Me</button>");
$("button").addClass("contactme").click(function(){
	$(this).prev().show();
	$(".contactform > button").hide();
});

$("button[type=reset]").click(function(){
	$(".contactform form").hide();
	$(".contactform > button").show();
});
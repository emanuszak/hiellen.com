$().ready(function() {
    
/*
    var date = moment().format('YYYY');
    document.getElementById('year-today').innerHTML = date;
*/
    
    $("a[href^='http://']").attr("target","_blank");
    
    
    //Pre-load leads form project request type based on Services click
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
	const serviceQuery = urlParams.get('type');
	const serviceQueryCheckbox = '<span>I need a </span><input type="checkbox" name="project_type[]" id="' + serviceQuery + '" value="' + serviceQuery + '" class="for-screen-readers" checked><label for="' + serviceQuery + '"></label>';
	
	function hideShowFormElements() {
		$("#lead_contact fieldset").hide();
	    $(".lead-from-services").show().prepend(serviceQueryCheckbox);
	}
	
    switch (serviceQuery) {
	    case 'wp-managedhosting':
	    	let wpManagedHosting = 'WordPress Managed Hosting';
	    	hideShowFormElements();
	    	$("#wp-managedhosting").siblings("label").text(wpManagedHosting);
	    	break;
	    case 'email-custom-library':
	    	let emailCustomLibrary = 'Custom Email Library';
	    	hideShowFormElements();
	    	$("#email-custom-library").siblings("label").text(emailCustomLibrary);
	    	break;
	    case 'email-code-pack':
	    	let emailCodePack = 'Email Code Pack';
	    	hideShowFormElements();
	    	$("#email-code-pack").siblings("label").text(emailCodePack);
	    	break;
	    default:
	    	$("#lead_contact fieldset").show();
	    	$(".lead-from-services").hide();
    }
    
    $(".clear-params").click(function(){
	    window.location.href = window.location.href.split('?')[0];
    });
    
    if($(".lead-from-services input").prop("checked")) {
	    $(".lead-from-services label").click(function(){
		    window.location.href = window.location.href.split('?')[0];
	    });
    }
});

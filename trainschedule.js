$(".btn-primary").click( function(){ 

$.post( $("#myForm").attr("action"),$("#myForm :input").serializeArray(), function(info){ $("#result").html(info);});

});


$("#myForm").submit( function() {
	return false;
});


/*$("#sub").click( function(){ 

$.post( $("#SignForm").attr("action"),$("#SignForm :input").serializeArray(), function(info){ $("#result").html(info);});
clearInput();
});


$("#SignForm").submit( function() {
	return false;
});

function clearInput(){
	$("#SignForm :input").each( function(){
		$(this).val('');
	});
}*/
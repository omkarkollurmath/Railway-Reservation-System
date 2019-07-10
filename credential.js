$("#sub").click( function(){ 

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
}
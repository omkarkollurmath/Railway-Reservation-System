$("#sub").click( function(){ 

$.post( $("#myForm").attr("action"),$("#myForm").serializeArray(), function(info){ $("#result").html(info);});

});


$("#myForm").submit( function() {
	return false;
});
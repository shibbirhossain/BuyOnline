/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497*/

$( document ).ready(function() {
   	$.ajax({
		type: "POST",
		url: "processing.php",
		//async:false,
		cache: false,
		success: function(result){
			serverResponse(result);
		}
	});
});

$( document ).ready(function() {
   	$.ajax({
		type: "POST",
		url: "managerSession.php",
		//async:false,
		cache: false,
		success: function(result){
			greetManager(result);
		}
	});
});

function serverResponse(result){
	
	$("#processingtablebody").html(result);

}


function processItems(){

	//alert("clicked");

	   	$.ajax({
		type: "POST",
		url: "processingRemove.php",
		//async:false,
		cache: false,
		success: function(result){
			//alert(result);

			processResponse(result);
			//location.reload();
		}
	});
}


function processResponse(result){

	alert(result);
	window.location.reload();
}


function greetManager(result){

	$('#greet').html("<h4>Welcome, <b>"+result+"</b>!</h4>");
}
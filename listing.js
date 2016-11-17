/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497

*/

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


function addItem(){

//alert("clicked");


	var name = $("#name").val();
	var price = $("#price").val();
	var quantity = $("#quantity").val();
	var description = $("#description").val();

	var dataString = 'name='+name + '&price=' + price + '&quantity=' + quantity + '&description='+ description;

	$.ajax({

		type: "POST",
		url: "listing.php",
		async:false,
		data: dataString,
		cache: false,
		success: function(result){
			serverResponse(result);
		}
	});
}

function serverResponse(result){
	
	alert("From serverResponse : "+result);
	//location.href = "https://mercury.ict.swin.edu.au/cos80021/s100864497/Assignment2/buyonline.htm";
	//$("#table").reset();
	$('#name').val("");
	$('#price').val("");
	$('#quantity').val("");
	$('#description').val("");
	//location.href="buyonline.htm";
}

function reset(){
	$('#name').val("");
	$('#price').val("");
	$('#quantity').val("");
	$('#description').val("");
}


function greetManager(result){

	$('#greet').html("<h4>Welcome, <b>"+result+"</b>!</h4>");
}
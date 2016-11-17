/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497*/

function submitLoginForm(){

	var email = $("#email").val();
	var password = $("#pwd").val();


	var dataString = 'email='+email +'&password='+ password;


		$.ajax({
		type: "POST",
		url: "customerLoginSubmit.php",
		//async:false,
		data: dataString,
		cache: false,
		success: function(result){
			serverResponse(result);
		}
	});
}


function serverResponse(result){
	
	//alert("From serverResponse :"+result);
	//location.href = "https://mercury.ict.swin.edu.au/cos80021/s100864497/Assignment2/buyonline.htm";

	if(result == "1"){
		alert("You are authenticated");	
		location.href = "buying.htm";
	}
	else alert(result);
	//location.href="buyonline.htm";
}
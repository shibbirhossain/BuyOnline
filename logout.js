/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497*/
$( document ).ready(function() {
    console.log( "ready!" );

    $.ajax({

    	type: "POST",
    	url:'logout.php',
    	success: function(result){
    		console.log("we do things here :"+result);
    		//alert("You are now logged out "+result);
    		printThankyouMessage(result);
    	}

    });
});


function printThankyouMessage(result){
	if(result === "0"){
		location.href = "https://mercury.ict.swin.edu.au/cos80021/s100864497/Assignment2/buyonline.htm";

	}
	else{
		$("#message").append("Thank you "+result+", you have successfully logged out.");	
	}
	

}
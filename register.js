/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497*/

function submitRegisterForm() {
	


	var firstname = $("#firstname").val();
	var lastname = $("#lastname").val();
	var email = $("#email").val();
	var password = $("#pwd").val();
	var confirmPassword = $("#repwd").val();
	var contact = $("#contact").val();

	var isDataValid = validateFormData(firstname, lastname, email, password, confirmPassword, contact);

if(isDataValid){

	var dataString = 'email='+email + '&fname=' + firstname + '&lname=' + lastname + '&password='+ password + '&contact='+contact;



	//alert(firstname);

	$.ajax({
		type: "POST",
		url: "registersubmit.php",
		async:false,
		data: dataString,
		cache: false,
		success: function(result){
			serverResponse(result);
		}
	});

}
//else alert("Form Data not valid");
	//location.href = "buyonline.htm";
}

function validateFormData(firstname, lastname, email, password, confirmPassword, contact){

	var isValid = true; 
	var problems="";

	if(firstname == "" || lastname== ""){
		isValid = false;
		problems += "Names can not be null \n";
	}
    if(!isValidEmailAddress(email)){
		isValid = false;
		problems += "Email format is not valid \n";
	}
	if( password != confirmPassword){
		isValid = false; 
		problems += "Password fields value mismatch \n";
	}
	if(password == "" || confirmPassword == ""){
		isValid = false;
		problems += "Password fields can not be empty \n";
	}

	if(isValid == false){
		alert("You have following problems in the form: \n"+problems);	
	}
	
	return isValid;
}

function serverResponse(result){
	
	alert("From serverResponse :"+result);

	if(result ==="Duplicate entry found"){
		window.location.reload();
	}
	else{
		location.href = "buyonline.htm";
	}
	
	//location.href="buyonline.htm";
}

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
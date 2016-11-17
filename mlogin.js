/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497*/

$( document ).ready(function() {
    console.log( "ready!" );

    $.ajax({

    	type: "POST",
    	url:'mlogin.php',
    	data:{
    		action: 'checkSession',
    	},
    	
    	success: function(result){
    		console.log("we do things here :"+result);

    		if($.trim(result) != "fail"){
                showManagerView(result);
    		}
            else if ($.trim(result) == "fail"){
                $("#form").show();
            }

    	}

    });
});

function submitLoginForm() {
	var mid = $("#mid").val();
	var password = $("#password").val();
	
    //alert(mid +" "+password);
    
	var dataString = 'mid='+mid + '&password=' + password;
	$.ajax({

			type: "POST",
            url: 'mlogin.php',
            dataType: 'json',
            cache: false,
            data:{
           	action:'checkManager',
           	mid: mid,
           	password: password
           },
           success:function(html) {
             //alert(html);

             if($.trim(html.message1) == "Success"){
             	alert("we are validated Manager, "+html.message2);
             	showManagerView(html.message2);

             }
             else if($.trim(html.message1) == "Fail"){
             	alert("we are sorry, wrong credential");
             }
           }
	});
}


function showLinks(){

	//var check = "<?php echo $_SESSION['manager_id'] ?>";
	//alert("From session "+check);
	$("#form").hide();
	$("#link").append("<p>Hello manager</p>");
	$("#link").append("<a href='listing.htm'>Listing</a><span>&nbsp;&nbsp;&nbsp;</span>");
	$("#link").append("<a href='processing.htm'>Processing</a><span>&nbsp;&nbsp;&nbsp;</span>");
	$("#link").append("<a href='logout.php'>Logout</a><span>&nbsp;&nbsp;&nbsp;</span>");
}

function showManagerView(result){

	//var check = "<?php echo $_SESSION['manager_id'] ?>";
	//alert("From session "+check);
	$("#form").hide();
	$("#link").append("<p>Hello "+result +"</p>");
	$("#link").append("<a href='listing.htm'>Listing</a><span>&nbsp;&nbsp;&nbsp;</span>");
	$("#link").append("<a href='processing.htm'>Processing</a><span>&nbsp;&nbsp;&nbsp;</span>");
	$("#link").append("<a href='logout.htm'>Logout</a><span>&nbsp;&nbsp;&nbsp;</span>");
}



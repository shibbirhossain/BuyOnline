/*AUTHOR NAME: MD Shibbir Hossain
Student ID: 100864497*/

$( document ).ready(function() {
   	$.ajax({
		type: "POST",
		url: "buying.php",
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
		url: "customerSession.php",
		//async:false,
		cache: false,
		success: function(result){
			greetCustomer(result);
		}
	});
});

window.setInterval(function test() {
	
	$.ajax({
		type: "POST",
		url: "buying.php",
		//async:false,
		cache: false,
		success: function(result){
			serverResponse(result);
		}
	});
},10000);


function serverResponse(result){
	
	//alert("From serverResponse "+result);

	$("#description").html(result);
	//location.href="buyonline.htm";
}

function addItem(name){

	//alert(name);
	
	var dataString = 'name='+name;


	$.ajax({
		type: "POST",
		url: "addItem.php",
		//dataType: 'json',
		//async:false,
		data: dataString,
		cache: false,
		success: function(result){
			
			addToCart(result);
		}
	});

}


function addToCart(result){

	//alert(result);
	//alert(result.price);
	//alert(result.quantity);

	//var spantag = "<table class='table' border='1' id='cartTable'><thead><tr><th>Title</th><th>Qty</th><th>Price</th><th>Remove</th></tr></thead>";


	//spantag += "<tbody> <tr><td>"+ result.id +"</td><td>"+result.price+"</td><td>"+result.quantity+"</td><td><button class='btn btn-danger'>Remove from cart</td></tr></tbody>";

	//spantag += "</table>";
	$("#cart").html(result);

	var sum =0;
			$(".tablerow").each(function() {
    			var x = $(this).find(".price").text();
    			var y = $(this).find(".hold").text();

    			var quantityOnHold = parseFloat(x);
    			var priceOfItem = parseFloat(y);
    			//alert(quantityOnHold + " : "+priceOfItem);

    			sum += (quantityOnHold * priceOfItem);
			});

			//alert(sum);

			updateCartTotal(sum);
	
}


function removeItem(name){

		//alert(name);

		var dataString = 'name='+name;

		$.ajax({
		type: "POST",
		url: "removeItem.php",
		data: dataString,
		cache: false,
		success: function(result){
			
			//alert(result);
			$("#cart").html(result);
			var sum =0;
			$(".tablerow").each(function() {
    			var x = $(this).find(".price").text();
    			var y = $(this).find(".hold").text();

    			var quantityOnHold = parseFloat(x);
    			var priceOfItem = parseFloat(y);
    			//alert(quantityOnHold + " : "+priceOfItem);

    			sum += (quantityOnHold * priceOfItem);
			});

			//alert(sum);

			updateCartTotal(sum);
		}
	});
}


function updateCartTotal(sum){

	$("#cartTotal").text("Total :" + sum);
	$("#confirmPurchase").text("");

}

function confirmPurchase(){
	//alert("confirmPurchase");

	$.ajax({
		type: "POST",
		url: "confirmPurchase.php",
		cache: false,
		success: function(result){	
			
			var sum =0;
			$(".tablerow").each(function() {
    			var x = $(this).find(".price").text();
    			var y = $(this).find(".hold").text();

    			var quantityOnHold = parseFloat(x);
    			var priceOfItem = parseFloat(y);
    			//alert(quantityOnHold + " : "+priceOfItem);

    			sum += (quantityOnHold * priceOfItem);

    			//alert(sum);
    		});

			//$("#cartTable").hide();
			$("#cart").text("");
    		$("#confirmPurchase").text("Your purchase has been confirmed and total amount due to pay is $"+sum);

    	}
			});
}

function cancelPurchase(){

		//alert("cancelPurchase");

		$.ajax({
		type: "POST",
		url: "cancelPurchase.php",
		cache: false,
		success: function(result){	
			
			//$("#cartTable").hide();
			$("#cart").text("");
    		$("#confirmPurchase").text("Your purchase request has been cancelled, welcome to shop next time.");

    	}
			});
}


function customerLogOut(){

	//alert("customerLogOut");

	cancelPurchase();
	location.href = "logout.htm";

}


function greetCustomer(result){
	if(result){
		$("#greet").html("<h4>Welcome, <b>"+result+"</b>!");	
	}
	
}
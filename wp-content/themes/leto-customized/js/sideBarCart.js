/*   TODO MAYBE */



jQuery(document).ready( function ( $ ) {
	//alert("scrtip loaded");

	var jQueryObj = $(".product-quantity")[1];
	var dataVal = $(jQueryObj).data();

	console.log( dataVal );
})



/*
( function ( $ ) {
	$(document).ready(function() {
		alert("loaded sidecartscript");
		var element = $(".cart-collaterals");
		var offset = element.offset();
		var elemRect = element.clientRect();

		element.appendTo("body");
		//element.offset(offset);//.addCLass(".custom-side-bar-cart");
	});
}) ( jQuery );
*/


/*
( function ( ) {
	document.addEventListener('DOMContentLoaded', function () {
		//alert("loaded sidecartscript");
		//document.querySelector(".viewcart").style.visibility = 'hidden'; 

		var element = document.getElementsByClassName("cart-collaterals col-md-3")[0];
		//var element = document.querySelector(".woocommerce .cart-collaterals");
		var elemRect = element.getBoundingClientRect();
		//element.style.backgroundColor = "red";

		//var newDiv = document.createElement('div');
		//newDiv.appendChild(element);
		//document.body.appendChild(element);
		//newDiv.style.backgroundColor = 'lightblue';
		//newDiv.style.height = '2000px';

		//document.body.style.overflow = 'visible';
		//document.body.style.display = 'unset';
		//document.body.style.height = '100%';

		//document.documentElement.style.overflow = 'visible';

		//element.style.position = '-webkit-sticky';
		//element.style.position = 'sticky';
		//element.style.bottom = '0px';
		//element.style.left = elemRect.left+'px';
	});
}) ( );*/
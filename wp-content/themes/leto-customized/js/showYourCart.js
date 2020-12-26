/*
( function ( $ ) {
	$(document).ready(function() {
		alert("loaded");
	    $(".single_add_to_cart_button").click(function() {
	    	alert("clicked");
	    	console.log("clicked");
	    });
	});
}) ( jQuery );
*/

( function ( ) {
	document.addEventListener('DOMContentLoaded', function () {
		//document.querySelector(".viewcart").style.visibility = 'hidden'; 
		document.querySelector(".woocommerce.single-product form.cart div button").onclick = function() {
			document.querySelector(".viewcart").style.visibility = 'visible'; 
		}
		document.querySelector(".woocommerce.single-product form.cart .button-wrapper button").onclick = function() {
			document.querySelector(".viewcart").style.visibility = 'visible'; 
		}
	});
}) ( );
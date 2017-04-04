/*globals $:false */
$(document).ready(function() {

	//show the about us part only
	$("#editProduct").hide();
	$("#sales").hide();
	$("#editUser").show();

	$("#meditProduct").click(function(){
		$("#editProduct").show();
		$("#editUser").hide();
		$("#sales").hide();
	});

	$("#meditUser").click(function(){
		$("#editProduct").hide();
		$("#editUser").show();
		$("#sales").hide();
	});

	$("#msales").click(function(){
		$("#editProduct").hide();
		$("#editUser").hide();
		$("#sales").show();
	});

});
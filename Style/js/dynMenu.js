
/*globals $:false */
$(document).ready(function () {
	$("#aboutUs").show(); 
	$("#subject").hide();
	$("#products").hide();
	$("#help").hide();

	$("#mHome").click(function ()  {
		$("#aboutUs").show(); 
		$("#subject").hide();
		$("#products").hide();
		$("#help").hide();
	});

	$("#mHome1").click(function () {
		$("#aboutUs").show(); 
		$("#subject").hide();
		$("#products").hide();
		$("#help").hide();
	});

	$("#msub").click(function () {
		$("#aboutUs").hide(); 
		$("#subject").show();
		$("#main").show();
		$("#products").hide();
		$("#help").hide();
		$("#moutcome").hide(); 
		$("#mVideo").hide();
	});

	$("#mprod").click(function () {
		$("#aboutUs").hide(); 
		$("#subject").hide();
		$("#products").show();
		$("#help").hide();
	});


	$("#mnewAccount").click(function () {
		$("#aboutUs").hide(); 
		$("#subject").hide();
		$("#products").hide();
		$("#help").hide();
	});

	$("#mHelp").click(function () {
		$("#aboutUs").hide(); 
		$("#subject").hide();
		$("#products").hide();
		$("#help").show();
	});

	$("#mHelp1").click(function () {
		$("#aboutUs").hide(); 
		$("#subject").hide();
		$("#products").hide();
		$("#help").show();
	});
	$("#msub1").click(function () {
		$("#aboutUs").hide(); 
		$("#subject").hide();
		$("#products").show();
		$("#help").hide();
	});

	//subject page navigation

	//Math
	$("#mMathOutcome").click(function () { 
		$("#moutcome").show(); 
		$("#main").hide(); 
		$("#mVideo").hide();
	});
	$("#mMathVideo").click(function () { 
		$("#moutcome").hide(); 
		$("#main").hide(); 
		$("#mVideo").show();
	});
	$("#mMathOverview").click(function () { 
		$("#moutcome").hide(); 
		$("#main").show(); 
		$("#mVideo").hide();
	});

	//Java
	$("#java").click(function () { 
		$("#joutcome").hide(); 
		$("#jMain").show(); 
		$("#jVideo").hide();
	});
	$("#mJavaOutcome").click(function () { 
		$("#joutcome").show(); 
		$("#jMain").hide(); 
		$("#jVideo").hide();
	});
	$("#mJavaVideo").click(function () { 
		$("#joutcome").hide(); 
		$("#jMain").hide(); 
		$("#jVideo").show();
	});
	$("#mJavaOverview").click(function () { 
		$("#joutcome").hide(); 
		$("#jMain").show(); 
		$("#jVideo").hide();
	});

	//PHP
	$("#php").click(function () { 
		$("#poutcome").hide(); 
		$("#pMain").show(); 
		$("#pVideo").hide();
	});
	$("#mPhpOutcome").click(function () { 
		$("#poutcome").show(); 
		$("#pMain").hide(); 
		$("#pVideo").hide();
	});
	$("#mPhpVideo").click(function () { 
		$("#poutcome").hide(); 
		$("#pMain").hide(); 
		$("#pVideo").show();
	});
	$("#mPhpOverview").click(function () { 
		$("#poutcome").hide(); 
		$("#pMain").show(); 
		$("#pVideo").hide();
	});

	//Database
	$("#db").click(function () { 
		$("#doutcome").hide(); 
		$("#dMain").show(); 
		$("#dVideo").hide();
	});
	$("#mDbOutcome").click(function () { 
		$("#doutcome").show(); 
		$("#dMain").hide(); 
		$("#dVideo").hide();
	});
	$("#mDbVideo").click(function () { 
		$("#doutcome").hide(); 
		$("#dMain").hide(); 
		$("#dVideo").show();
	});
	$("#mDbOverview").click(function () { 
		$("#doutcome").hide(); 
		$("#dMain").show(); 
		$("#dVideo").hide();
	});
});

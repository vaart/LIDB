$(document).ready(function(){

	$("#RegisterBtn").click(function(){
		$("#loginForm").fadeOut(0);
		$("#registration").fadeIn(300);
		});
	$("#loginBtn").click(function(){
		$("#registration").fadeOut(0);
		$("#loginForm").fadeIn(300);
		});



	$("#userReg_btn").click( function(){

		var username 	= $("#username").val();
		var pass1 		= $("#pass1").val();
		var pass2 		= $("#pass2").val();
		var city		= $("#city").val();
		var validReg 	= validateUserReg( username, pass1, pass2 );

		if( validReg ){
			var dataSrc = "userRegistration";
			var data = { "username": username, "password": pass1, "city": city }

			sendData( dataSrc, data )
			alert("You are registered!");

		}
	} );

	$("#logoutLink").click( function(){
		var dataSrc = "logout";
		var data 	= "";

		sendData( dataSrc, data );

	});

	$("#userLogin_btn").click( function(){
		console.log("logging in");
		var username 	= $("#login_username").val();
		var pass1 		= $("#login_pass1").val();

		//Add validation step
		
		var dataSrc = "userLogin";
		var data = { "username": username, "password": pass1 }

			sendData( dataSrc, data );
	} );

	$("#profile_btn").click( function(){
		console.log("TEST SUCCESS");

		var liquorName 				= $("#liquorName").val();
		var liqourType 				= $("#liqourType").val();
		var liquorManufacturer 		= $("#liquorManufacturer").val();
		var liquorAge 				= $("#liquorAge").val();
		var liquorCountryOfOrigin 	= $("#liquorCountryOfOrigin").val();
		var liquorRating 			= $("#liquorRating").val();

		//Preparing the data for back end
		var dataSrc = "userProfile";
		//This is a JSON
		var data 	= { "liquorName" : liquorName, "liqourType" : liqourType, "liquorManufacturer" : liquorManufacturer, "liquorAge" : liquorAge, "liquorCountryOfOrigin" : liquorCountryOfOrigin, "liquorRating" : liquorRating };

			sendData( dataSrc, data );

	});



	function sendData( dataSrc, data ){
		console.log( "sendData() initialized...")
		
		$.post("api/", { "dataSource": dataSrc, "data": data }).done( function( data ){
			//This below executes when the server has responded
			//convert string to json
			obj = JSON.parse(data);

			switch(obj.status.status){

			 	case "User logged in":
			 		 loginHandler();
			 		break;

			 	case "session terminated":
			 		logoutHandler();
			 		break;
			 	case "no user":
			 		alert("SORRY YOUR USERNAME IS NOT FOUND")
			 		break;

			}
			if( obj.status.status == "User logged in"){
				location.reload();
			}
		});
	}

	function loginHandler(){
		location.reload();
	}

	function logoutHandler(){
		location.reload();
	}

	function validateUserReg( username, pass1, pass2 ){
		console.log( "validateUserReg() initialized...")
		var result = false;

		if( username != "" && pass1 != "" && pass2 != "" ){
			if( pass1 == pass2 ){
				if( pass1.length > 5 ){

					result = true;

				}else{
					alert("Password must be at least 6 characters long")
				}
			}else{
				alert("Passwords do not match");
			}
		}else{
			alert("All fields are required!");
		}

		return result;
	}
});
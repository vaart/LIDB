<?php

	/**
	 * index.php is the API landing page. This page serves as a router.
	 * Utilizing the $dataSource defined in config.php the API routes the requests.
	 */
	include_once("config/config.php");
	//echo ":)";
	//Array for results data that is sent back to 
	//front end
	$result 	= array();

	//Switch Routes the request depending on the 
	//value of dataSource
	switch( $dataSource ){
		case "userRegistration":
			 $result['status'] 	 = $userMgr->registerUser( $request['username'], $request['password'], $request['city']);
			break;
		case "userLogin":
			$result['status'] 	 = $userMgr->loginUser( $request['username'], $request['password']);
			break;
		case "logout":
			$result['status'] 	 = $userMgr->logoutUser();
			break;
		case "userProfile":
			$result['status'] 	= $userMgr->setUserMetaData( $request['liquorName'], $request['liqourType'], $request['liquorManufacturer'], $request['liquorAge'], $request['liquorCountryOfOrigin'], $request['liquorRating'],);
			break;
	}

	//This sends the result back to JS .done() method
	echo json_encode( $result );

?>
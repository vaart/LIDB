<?php
/**
 * User Manager Handles User Management tasks such as Registration, Password Resets, Login.
 */

class UserManager{
	 private $dbCon 				= false;
	 private $db 					= false;
	 private $sysMgr 				= false;
	 private $data 					= false;
	 public $sessionID 				= "";
	 private $sessionTimeOut 		= 5400; // 1.5 hrs
	 private $userRecord			= array();
	 private $userID 				= 0;


	public function __construct(){
		$this->dbCon = new dbCon();
		$this->sysMgr = new SystemManager();
	}

//////////////////PRIVATE METHODS/////////////////////////
	private function initiateSession( $userID ){
		// server should keep session data
		//ini_set( 'session.gc_maxlifetime', $this->sessionTimeOut );
		// each client should remember their session id
		//session_set_cookie_params( $this->sessionTimeOut );
		 if( !isset($_SESSION) ){
		 	 session_start();
		 }
		
		 session_regenerate_id();

		//ASSIGN USER VARIABLES
		$this->sessionID 				= session_id();
		//CREATE SESSION COOKIES
		$_SESSION[ 'LAST_ACTIVITY' ] 	= time();
		
		 $_SESSION[ 'userID' ] 			= $userID;
		 $_SESSION[ 'sessionID' ] 		= $this->sessionID;
		 $_SESSION[ 'browserName' ] 	= $this->sysMgr->getBrowserName();
		 $_SESSION[ 'browserVersion' ]  = $this->sysMgr->getBrowserVersion();
		 $_SESSION[ 'platform' ] 		= $this->sysMgr->getPlatform();

		// //CLOSE PREVIOUS SESSIONS
		 $u 	= $this->dbCon->updateRecord( 
										"user_session", 
										array( "active"), 	//fieldToUpdate
										array( 0 ),  			//fieldValue
										array( "userID" ), 		// Where
										array( $userID )	// Values of Where
										);
		// //RECORD NEW SESSION
		$q = $this->dbCon->insertRecord( 
								"user_session", 
								array("userID", "sessionID", "active", "browsername", "browserversion", "osplatform" ), 
								array( $userID, $this->sessionID, 1, $_SESSION[ 'browserName' ], $_SESSION[ 'browserVersion' ], $_SESSION[ 'platform' ] ) 
								);
		
		return $userID;

	}

	private function terminateSession( $sesID ){
		//logout procedures go here
		if( $sesID != session_id() ){ $sesID = session_id(); }

		$u 	= $this->dbCon->updateRecord( 
											"user_session", 
											array( "active"), 	//fieldToUpdate
											array( 0 ),  			//fieldValue
											array( "sessionID" ), 		// Where
											array( $sesID )			// Values of Where
											);
		//Unset and Destroy Session
		session_unset();
		session_destroy();
		$res['status'] = 'session terminated';
		return $res;
	}

	/**
	 * [getUser description]
	 * Gets a USER from DB using either ID, userName or verificationCode
	 * @access private
	 * @param  [string] $argType
	 * @param  [string] $userData
	 * @return [boolean] $exists
	 */
	private function getUser( $argType, $userData ){
		switch( $argType ){
			case 'userName'			: 
				$q = $this->dbCon->pullRecordWithParameters( "users", array( "userName" => $userData ));
				break;
			case 'userID'			: 
				$q = $this->dbCon->pullRecordWithParameters( "users", array( "userID" => $userData ) ); 
				break;
			case 'verificationCode'	: 
				$q = $this->dbCon->pullRecordWithParameters( "users", array( "verificationCode" => $userData ) ); 
				break;
		}

		$this->userRecord	= $q;
		$recordCount = count($this->userRecord);

		if( $recordCount  > 0 ){ 
			$exists = true; 
		}else{ $exists = false; }

		return $exists;
	}

	private function verifyUserToken( $token ){
		$result = false;
		$sql = $this->dbCon->pullRecordWithParameters("user_session", array( "sessionID"=>$token ));

		if( count($sql) > 0 ){
			$this->getUser( 'userID', $sql[0]['userID']);
			$result  = true;
		}

		return $result;
	}

	private function getUserData( ){

	}

	private function setUserData( $field, $value ){

		if( $this->verifyUserToken( $_SESSION['sessionID']) ){
			$res = $this->dbCon->insertRecord("user_meta",
								array( "userID", "fieldKey", "fieldValue" ),
								array( $this->userRecord[0]['userID'], $field, $value )
								);
		}else{
			$res['status'] = "error";
		}

		return $res;
	}

	private function userExists( ){

	}

	private function isScreenNameUnique( ){

	}

	private function isUserLoggedIn( ){

	}

	private function getNavigation(){

	}

	private function getUserRoles(){
	
	}


/////////////////////PUBLIC METHODS //////////////////////////////////

	public function me(){
		return $_SESSION['sessionID'];
	}

	public function registerUser( $username, $pass, $city ){
		 $result = array();
		// //check is user exists in user table - this returns an array
		 $sql = $this->dbCon->pullRecordWithParameters("users", array("username"=>$username));
		// //if the user exists then send error back UI
		// //hint: use count() to check the lenght of array
		if( count($sql) > 0 ){
		 	$result['status'] 	= "error";
		 	$result['details'] 	= "User already exists in database";
		 }else{
		// 	//if user doesn't exist create record in user table
		 	$newUserID = $this->dbCon->insertRecord( "users",
		 								array("username", "auth", "city", "verificationToken", "verified"),
		 								array( $username, create_hash($pass), $city, createToken(), 0 )
		 								);
		// 	//initiate session
		 	$this->initiateSession( $newUserID );

		 	$result['status'] 	= "success";
		 	$result['token'] 	= $this->me();
		 	$result['details']  = "User automatically logged in";
		 }

		return $result;
	}

	public function loginUser( $username, $password ){
		//$result = false;
		$status = "NA";
		$test = '';
		
		if( $this->getUser( "userName", $username ) ){

			//$result 			= true;
			$pwHash 			= $this->userRecord[0]['auth'];
		
			//if( validate_password( $password, $pwHash ) ){	
				//OPEN USER SESSIONS
				$this->initiateSession( $this->userRecord[0]['userID'] );
				//RETURN 'ME' JSON OBJECT
				$result['status'] = 'User logged in';
				$result['token'] = $this->me();
				//return 
			//}
		}else{
			$result['status'] = "no user";
		}
		return $result;
	}

	public function logoutUser( ){
		return $this->terminateSession( $_SESSION['sessionID'] );
	}

	public function getUserMetaData(){

	}

	public function setUserMetaData( $liquorName, $LiqourType, $liquorManufacturer, $liquorAge, $liquorCountryOfOrigin, $liquorRating ){
		$result = array();
		// //check is user exists in user table - this returns an array
		 $sql = $this->dbCon->pullRecordWithParameters("liquors", array("liqourName"=>$liquorName));
		// //if the user exists then send error back UI
		// //hint: use count() to check the lenght of array
		if( count($sql) > 0 ){
		 	$result['status'] 	= "error";
		 	$result['details'] 	= "Liqour already exists in database";
		 }else{
		// 	//if user doesn't exist create record in user table
		 	$newliquorID = $this->dbCon->insertRecord( "liqours",
		 								array("liquorName", "liqourType", "liquorManufacturer", "liquorAge", "liquorCountryOfOrigin", "liquorRating"),
		 								array( $liquorName, $liqourType, $liquorManufacturer, $liquorAge, $liquorCountryOfOrigin, $liquorRating )
		 								);
	}

	public function verifyUser(){

	}

	public function passwordResetRequest(){

	} 

	public function verifyResetCode( ){

	}

	public function resetPassword(){

	}
}
?>
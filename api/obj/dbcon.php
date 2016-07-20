<?php
	/**
	 * dbCon() object is in charge of database requests. SELECT, INSERT and UPDATE
	 * use the dbCon() methods to send or get data to and from database.
	 */
	class dbCon{
		//Update these to match your database
		private $db;
		private $dbName 	= 'olsen_app1';
		private $username 	= 'root';
		private $password	= '';
		private $host 		= 'localhost';


		public function __construct() {
			$this->db = new mysqli( $this->host, $this->username, $this->password, $this->dbName );	
		}
		
		/**
		 * getDB() selects the database connection
		 */
		public function getDb() {
			return $this->db;
		}
		
		/**
		 * closeDB() closes database connection
		 */
		public function closeDb() {
			$this->db->close();
		}

		/**
		 * pullRecord() gets all the records in a table
		 * $tID 		is the database table name
		 */
		public function pullRecord( $tID ) {
			$where = array();
			$result = $this->sqlExecute( 'select', $tID, $where );
			$retArr = array();
			while ( $row = $result->fetch_assoc() ) {
				$retArr[] = $row;
			}
		  return $retArr;
		}

		/**
		 * pullRecordWithParameters() selects a record from the database using parameters 
		 * sent to as an array
		 * $tID 				is the database table name
		 * $where 				parameters for record search
		 */
		public function pullRecordWithParameters( $tID, $where ) {

			if( !isset( $where ) ) $where = array();
			$result = $this->sqlExecute( 'select', $tID, $where );
			$retArr = array();

			while ($row = $result->fetch_assoc()) {
				$retArr[] = $row;
			}
		  return $retArr;
		}

		/**
		 * inserRecord() inserts a record into a database table
		 * $table 		database table name
		 * $fields 		database table field names in an array
		 * $values 		database table field values in an array
		 * RETURN 		this returns the record ID of the new user
		 */
		public function insertRecord( $table, $fields, $values ){

			//Clean up the incoming fields from malicious scripts
			for( $i = 0; $i < count($fields); $i++ ){ $fields[$i] = cleanUp( $fields[$i] ); }
			//Clean up the incoming values from malicious scripts
			for( $j = 0; $j < count($values); $j++ ){ $values[$j] = cleanUp( $values[$j] ); if( !is_numeric ($values[$j] ) ){ $values[$j] = "'".$values[$j]."'"; }else{ $values[$j] = $values[$j]; } }
			//Convert Arrays to strings
			$c_fields 		= implode(', ', $fields );
			$c_values 		= implode(', ', $values );
			//Set up dynamic INSERT Query and Execute
			$query 			= "INSERT INTO ".$table." ( ".$c_fields." ) VALUES ( ".$c_values." )";
			$result 		= $this->db->query($query);
			$insertedIndex 	= $this->db->insert_id;
			//Return Query to UserManager()
			return $insertedIndex;
		}

		/**
		 * updateRecord() updates a record in database tables
		 * $table 			database table name
		 * $fields 			array of fields to be updated
		 * $values 			array of values for fields to be updated
		 * $where 			array of field conditions
		 $ $whereVal 		array of field value conditions
		 */
		public function updateRecord( $table, $fields, $values, $where, $whereVal ){

			$qryStr = '';
			$qryStr .= 'UPDATE '.$table.' set ';

			if (isset($fields) && count($fields)>0) {
				for($f = 0; $f < count($fields); $f++ ) {
					$values[$f] = cleanUp( $values[$f] ); 
					if( !is_numeric ($values[$f] ) ){ 
						$values[$f] = "'".$values[$f]."'"; 
					}else{ 
						$values[$f] = $values[$f]; 
					} 

					$qryStr .= $fields[$f].' = '.$values[$f];
				}
			}

			$qryStr .= ' WHERE ';

			if (isset($where) && count($where)>0) {
				for($w = 0; $w < count($where); $w++ ) {
					if( !is_numeric ($whereVal[$w] ) ){ 
						$whereVal[$w] = "'".$whereVal[$w]."'"; 
					}else{ 
						$whereVal[$w] = $whereVal[$w]; 
					} 
					if( $w == count($where) - 1 ){
						$qryStr .= $where[$w]." = ".$whereVal[$w];
					}
					else{
						$qryStr .= $where[$w]." = ".$whereVal[$w]. " AND ";
					}
				}
			}

			$result 		= $this->db->query($qryStr);
			
			return $result;
		}

		/**
		 * sqlExecute() private method. This method executes the queries on database
		 */
		private function sqlExecute($type, $table, $param) {
			$paramIndex = 0;
			$result = false;
			$qryStr = '';
			$valid = true;
			switch (strtoupper($type)) {
				case 'SELECT':
					$qryStr = strtoupper($type).' * FROM '.$table;
					if (isset($param) && count($param)>0) {
						$qryStr .= ' WHERE';
						foreach($param as $key => $value) {;
							
							if(!is_numeric($value)) $value = '"'.$value.'"';
							$qryStr .= ' '.$key.'='.$value;
							
							$paramIndex++;
							if($paramIndex < count($param)){
								$qryStr .= ' AND ';
							}
						}
					}
					
					break;
				default:
					$valid = false;
					break;
			}
			if ($valid) {
				$qryStr .= ';';
				$result = $this->db->query($qryStr);	
			}
		  return $result;
		}

	}
?>
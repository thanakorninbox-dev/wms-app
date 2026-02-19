<?php

// db connection
/** overide native PDO function */
class database extends PDO {

	protected $query;

	public function __construct($dsn, $username = '', $password = '', $driver_options = array()) {
		parent::__construct($dsn, $username, $password, $driver_options);
		$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('db_statement', array($this)));
	}

	public function last_query() {
		return $this->query;
	}

}

/** overide native PDO statement */
// for XSS protection
class db_statement extends PDOStatement {

	protected $pdo;

	protected function __construct($pdo) {
		$this->pdo = $pdo;
	}

	public function execute($args = null) {
		// Perform logging here. PDO object is accessible
		// from $this->pdo.

		echo $this->pdo->last_query();

		if (!is_array($args)) {
			$args = func_get_args();
		}else{
			// escaping array
			// prevent store XSS
			foreach($args as &$item){
				// decode the JSON data
				// set second parameter boolean TRUE for associative array output.
				$result = json_decode($item);
				if (json_last_error() === JSON_ERROR_NONE) {
					// encode html for json
					$tmp = json_decode($item,true);
					foreach((array)$tmp as &$ii){

						$result = json_decode($ii);
						if (json_last_error() === JSON_ERROR_NONE) {
							// json inside json
							$tmpp = json_decode($ii,true);
							foreach ((array)$tmpp as &$iii) {
								$iii = htmlspecialchars($ii, ENT_QUOTES, 'UTF-8');
							}
							$ii = json_encode($tmpp);
						}else{
							// string inside json
							$ii = htmlspecialchars($ii, ENT_QUOTES, 'UTF-8');
						}
						
					}
					$item = json_encode($tmp);
				}else{
					// encode html for string
					$item = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
				}
			}
		}
		return parent::execute($args);
	}

}

//..................... PDO1 .....................//
$pdo1 = new database($db_type.':host='.$db_server.';dbname='.$db_database.';charset=utf8', $db_user, $db_pass);

//..................... PDO2 .....................//
$pdo2 = new database($db_type2.':host='.$db_server2.';dbname='.$db_database2.';charset=utf8', $db_user2, $db_pass2);

?>
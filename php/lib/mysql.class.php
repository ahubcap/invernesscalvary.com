<?php
// Name        : mysql.class.php
// Description : Based on MySQL.
// Notes       :
// Modified    : 2010/07/28 - AZK - Created
// require_once('crypt.class.php');

class Result {
	public $result = false;

	function __construct($rs) {
		$this->result = $rs;
	}

	function __destruct() {
	}

	function checkResult() {
		return false===$this->result?false:true;
	}

	function check_result() {
		return $this->checkResult();
	}

	function next() {
		return $this->checkResult()?mysql_fetch_array($this->result, MYSQL_ASSOC):false;
	}

	function first() {
		return $this->checkResult()?mysql_data_seek($this->result, 0):false;
	}

	function fieldCount() {
		return $this->checkResult()?mysql_num_fields($this->result):0;
	}

	function field_count() {
		return $this->fieldCount();
	}

	function getFieldNames() {
		$data = array();
		$field_count = $this->field_count();
		for ($i=0; $i<$field_count; $i++) {
			$data[] = mysql_field_name($this->result, $i);
		}
		return $data;
	}

	function get_field_names() {
		return $this->getFieldNames();
	}

	function rowCount() {
		return $this->checkResult()?mysql_num_rows($this->result):0;
	}

	function row_count() {
		return $this->rowCount();
	}

	function free() {
		if (!$this->checkResult() || mysql_free_result($this->result)) {
			$this->result = false;
			return true;
		}
		return false;
	}
}

class DB {
	private static $conn;
	private $host;
	private $user;
	private $pass;
	private $db;

	function __construct($db='', $user='', $pass='', $host='') {
		$this->host = DB_HOST;
		$this->user = DB_USER;
		$this->pass = DB_PASS;
		$this->db = DB_DB;
		if (!empty($db) && !empty($user) && !empty($pass) && !empty($host)) {
			$this->db = $db;
			$this->user = $user;
			$this->pass = $pass;
			$this->host = $host;
		} elseif (!empty($db) && !empty($user) && !empty($pass) && empty($host)) {
			$this->db = $db;
			$this->user = $user;
			$this->pass = $pass;
		} elseif (!empty($db) && empty($user) && empty($pass) && empty($host)) {
			$this->db = $db;
		}
	}

	function __destruct() {
	}

	function getConnection() {
		if (empty(self::$conn)) {
// 			$c = new Crypt(DB_KEY);
// 			$c->setIV(DB_IV);
			for ($i=0; 10>$i; $i++) {
// 				self::$conn = mysql_connect($c->decrypt($this->host), $c->decrypt($this->user), $c->decrypt($this->pass));
				self::$conn = mysql_connect($this->host, $this->user, $this->pass);
				if (!empty(self::$conn)) {
// 					mysql_select_db($c->decrypt($this->db), self::$conn);
					mysql_select_db($this->db, self::$conn);
					break;
				}
				usleep(250000);
			}
		}
		return self::$conn;
	}

	function endConnection() {
		if (!empty(self::$conn)) {
			return mysql_close(self::$conn);
		}
		return true;
	}

	function checkConnection() {
		return mysql_ping(self::$conn);
	}

	function setDatabase($db) {
// 		$c = new Crypt(DB_KEY);
		$this->db = $db;
// 		return mysql_select_db($c->decrypt($this->db), $this->getConnection());
		return mysql_select_db($this->db, $this->getConnection());
	}

/*
	FUNCTION QUERY BIND (See sprintf types below)
	% - a literal percent character. No argument is required.
	b - the argument is treated as an integer, and presented as a binary number.
	c - the argument is treated as an integer, and presented as the character with that ASCII value.
	d - the argument is treated as an integer, and presented as a (signed) decimal number.
	e - the argument is treated as scientific notation (e.g. 1.2e+2). The precision specifier stands for the number of digits after the decimal point since PHP 5.2.1. In earlier versions, it was taken as number of significant digits (one less).
	E - like %e but uses uppercase letter (e.g. 1.2E+2).
	u - the argument is treated as an integer, and presented as an unsigned decimal number.
	f - the argument is treated as a float, and presented as a floating-point number (locale aware).
	F - the argument is treated as a float, and presented as a floating-point number (non-locale aware). Available since PHP 4.3.10 and PHP 5.0.3.
	g - shorter of %e and %f.
	G - shorter of %E and %f.
	o - the argument is treated as an integer, and presented as an octal number.
	s - the argument is treated as and presented as a string.
	x - the argument is treated as an integer and presented as a hexadecimal number (with lowercase letters).
	X - the argument is treated as an integer and presented as a hexadecimal number (with uppercase letters).
*/
	function query($sql, $bind=null, $force_null=true) {
		if (is_array($bind)) {
			for ($i=0; $i<count($bind); $i++) {
				$bind[$i] = $this->sqlSafe(trim($bind[$i]));
			}
			// TODO: Should rewrite to properly parse / bind.
			$sql = vsprintf($sql, $bind);
			if ($force_null) {
				$sql = str_replace(array("''",'""'),'null',$sql);
			}
		}
		$res = new Result(mysql_query($sql, $this->getConnection()));
		return $res;
	}

	function sqlSafe($s) {
		return mysql_real_escape_string($s, $this->getConnection());
	}

	function setAutoCommitOff() {
		$this->query("SET autocommit=0");
	}

	function setAutoCommitOn() {
		$this->query("SET autocommit=1");
	}

	function beginTransaction() {
		$this->query("BEGIN");
	}

	function commitTransaction() {
		$this->query("COMMIT");
	}

	function rollbackTransaction() {
		$this->query("ROLLBACK");
	}

	function affectedRows() {
		return mysql_affected_rows($this->getConnection());
	}

	function getLastInsertId() {
		return mysql_insert_id($this->getConnection());
	}

	function getLastErrorNo() {
		return mysql_errno($this->getConnection());
	}

	function getLastError() {
		return mysql_error($this->getConnection());
	}
}
?>
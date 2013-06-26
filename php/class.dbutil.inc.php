<?php
/*
	Clase para manejo de base de datos MySQL.
	Version: 1.2.1
	Created: long time ago.
	Modified: 2012-06-24
	Author: DriverOp. http://driverop.com.ar/
	Licence: LGPL 3. http://www.gnu.org/licenses/lgpl.html
*/
class cDB {
	var $link = NULL;
	var $errmsg = "";
	var $error = false;
	var $errno = 0;
	var $numrows = 0;
	var $affectedrows = 0;
	var $result = NULL;
	var $last_id = 0;
	var $lastsql = "";
	
	function __construct($dbhost = null, $dbname = null, $dbuser = null, $dbpass = null) {
		if (!empty($dbhost) and !empty($dbname) and !empty($dbuser) and !empty($dbpass)) {
			$this->Connect($dbhost, $dbname, $dbuser, $dbpass);
		}
	}
	
	function CheckError() {
		$this->errno = mysql_errno();
		$this->error = $this->errno != 0;
		$this->errmsg = $this->errno.": ".mysql_error();
		return $this->error;
	}
	
	function Connect($dbhost, $dbname, $dbuser, $dbpass) {
		$this->link = @mysql_connect($dbhost, $dbuser, $dbpass, true);
        if (!$this->CheckError()) {
            @mysql_select_db($dbname);
        }
        $this->CheckError();
        return $this->error;
    }
	
	function Disconnect() {
		if ($this->link !== NULL) {
			mysql_close($this->link);
			$this->link = NULL;
		}
	}
	
	function IsConnected() {
		if (!is_bool($this->link) and !($this->link == NULL)) {
			return true;
		} else {
			return false;
		}
	}
	
	function GetLink() {
		return $this->link;
	}
	
	function Query($sql) {
		$this->numrows = 0;
		$this->result = mysql_query($sql,$this->link);
		$this->lastsql = $sql;
		if (!$this->CheckError()) {	
			if (!is_bool($this->result)) {
				$this->numrows = mysql_num_rows($this->result);
			} else {
				$this->affectedrows = mysql_affected_rows($this->link);
			}
		}
		return $this->result;
	}
	
	function Update($tabla, $lista, $where = "") {
		$this->affectedrows = -1;
		if (!is_array($lista)) {
			$this->error = true;
			$this->errno = -1;
			$this->errmsg = "Segundo parámetro no es array ('campo'=>'valor')";
			return false; }
		else  {
			$sql = "UPDATE `".$tabla."` SET";
			foreach ($lista as $key => $value) {
				$sql .= " `".$key."` = '".$value."',";
			}
			$sql = substr($sql, 0, -1); // Quita la última coma.
			$where = trim($where);
			if (!empty($where)) {  $sql .= " WHERE ".$where; }
			$sql .= ";";
			$this->lastsql = $sql;
			$this->result = mysql_query($sql,$this->link);
			if (!$this->CheckError()) {
				$this->affectedrows = mysql_affected_rows($this->link);
				return true;
			} else {
				return false;
			}
		}
	}
	
	function Insert($tabla, $lista) {
		$this->affectedrows = -1;
		if (!is_array($lista)) {
			$this->error = true;
			$this->errno = -1;
			$this->errmsg = "Segundo parámetro no es array ('campo'=>'valor')";
			return false;
		} else {
			$sql = "INSERT INTO `".$tabla."` (`".implode("`, `",array_keys($lista))."`) VALUES ('".implode("', '",array_values($lista))."');";
			$this->lastsql = $sql;
			$this->result = mysql_query($sql,$this->link);
			if (!$this->CheckError()) {
				$this->last_id = mysql_insert_id($this->link);
				$this->affectedrows = mysql_affected_rows($this->link);
				return true;
			} else {
				return false; 
			}
		}
	}
	
	function Delete($tabla, $where) {
		$sql = "DELETE FROM `".$tabla."` WHERE ".$where.";";
		$this->lastsql = $sql;
		$this->result = mysql_query($sql);
		if (!$this->CheckError()) {
			$this->affectedrows = mysql_affected_rows($this->link);
			return true; }
		else {
			return false;
		}
	}

	function First($res = NULL) {
		if ($res == NULL) {
			$res = $this->result;
		}
		if (mysql_num_rows($res) > 0) {
			mysql_data_seek($res,0);
			return mysql_fetch_assoc($res);
		}
		else { return false; }
	}
	
	function Next($res = NULL) {
		if ($res == NULL) {
			$res = $this->result;
		}
		if (mysql_num_rows($res) > 0) {
			return mysql_fetch_assoc($res);
		}
		else { return false; }
	}

	function Last($res = NULL) {
		if ($res == NULL) {
			$res = $this->result;
		}
		if (mysql_num_rows($res) > 0) {
			mysql_data_seek($res,mysql_num_rows($res)-1);
			return mysql_fetch_assoc($res);
		} else { return false; }
	}

	function Seek($num, $res = NULL) {
		$result = false;
		if ($res == NULL) {
			$res = $this->result;
		}
		if (is_int($num)) {
			$num = (int)$num;
			if ((mysql_num_rows($res) > 0) and ($num < mysql_num_rows($res))) {
				mysql_data_seek($res,$num);
				$result = mysql_fetch_assoc($res);
			}
		}
		return $result;
	}
	
	function SeekBy($tabla, $campo, $valor, $altorden = null) {
		$result = false;
		if (!empty($tabla) and !empty($campo)) {
			$sql = "DESCRIBE `".$tabla."` `".$campo."`";
			$this->lastsql = $sql;
			$this->result = mysql_query($sql, $this->link);
			if (!$this->CheckError()) {
				$result = mysql_fetch_assoc($this->result);
				if ($result === FALSE) {
					$this->error = true;
					$this->errno = 1054;
					$this->errmsg = "Unknown column '".$campo."' in table '".$tabla."'";
				} else {
					$sql = "SELECT * FROM `".$tabla."` WHERE ";
					if ((stripos($result['Type'],"varchar(") == 0) or (stripos($result['Type'],"text") == 0)) {
						$sql .= "LOWER(`".$campo."`) LIKE LOWER('".$valor."')";
					} else {
						$sql .= "`".$campo."` = '".$valor."' ";
					}
					if (!empty($altorden)) {
						$sql .= " ORDER BY `".$altorden."`";
					}
					$this->Query($sql);
					$this->lastsql = $sql;
					if (!$this->error and $this->numrows > 0) {
						$result = $this->First();
					} else {
						$result = false;
					}
				}
			}
		}
		return $result;
	}
	
	function GetNumRows($res) {
		return mysql_num_rows($res);
	}

	function ShowLastError() {
		if ($this->error) {
			echo $this->errno.": ".$this->errmsg."<br />";
		}
	}
	
	function SetUTF8($value=true) {
		$sql = ($value)?"SET NAMES 'utf8'":"SET NAMES 'latin1'";
		$this->result = mysql_query($sql,$this->link);
		return $this->CheckError();
	}
	
}

?>
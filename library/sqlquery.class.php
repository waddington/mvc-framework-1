<?php

class SQLQuery {
	protected $_dbHandle;
	protected $_result;

	/* Connect to database */
	function connect($address, $account, $pwd, $name) {
		$this->_dbHandle = @mysqli_connect($address, $account, $pwd, $name);
		if ($this->_dbHandle) {
			if (mysqli_select_db($this->_dbHandle, $name)) {
				return 1;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	/* Disconnect from database */
	function disconnect() {
		if (@mysqli_close($this->_dbHandle) != 0) {
			return 1;
		} else {
			return 0;
		}
	}

	/* 	SQL QUERIES */
	function selectAll() {
		$query = 'SELECT * FROM '.$this->_table.';';
		return $this->query($query);
	}

	function select($id) {
		$query = 'SELECT * FROM '.$this->_table.' WHERE id = '.mysqli_real_escape_string($this->_dbHandle, $id).';';
		return $this->query($query, 1);
	}

	function query($query, $singleResult = 0) {
		$this->_result = mysqli_query($this->_dbHandle, $query);

		if (preg_match("/select/i", $query)) {
			$result = array();
			$table = array();
			$field = array();
			$tempResults = array();
			$numOfFields = mysqli_field_count($this->_dbHandle);

			for ($i=0; $i<$numOfFields; ++$i) {
				$tempField = mysqli_fetch_field($this->_result);
				array_push($table, $tempField->table);
				array_push($field, $tempField->name);
			}

			while ($row = mysqli_fetch_row($this->_result)) {
				for ($i=0; $i<$numOfFields; ++$i) {
					$table[$i] = trim(ucfirst($table[$i]), "s");
					$tempResults[$table[$i]][$field[$i]] = $row[$i];
				}
				if ($singleResult == 1) {
					mysqli_free_result($this->_result);
					return $tempResults;
				}
				array_push($result, $tempResults);
			}
			mysqli_free_result($this->_result);
			return $result;
		}
	}

	function getNumRows() {
		return mysqli_num_rows($this->_result);
	}

	function freeResult() {
		mysqli_free_result($this->_result);
	}

	function getError() {
		return mysqli_error($this->_dbHandle);
	}

	function clean($value) {
		return mysqli_real_escape_string($this->_dbHandle, $value);
	}
}
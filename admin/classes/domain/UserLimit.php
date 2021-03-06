<?php

/*
**************************************************************************************************************************
** CORAL Resources Module v. 1.0
**
** Copyright (c) 2010 University of Notre Dame
**
** This file is part of CORAL.
**
** CORAL is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
**
** CORAL is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License along with CORAL.  If not, see <http://www.gnu.org/licenses/>.
**
**************************************************************************************************************************
*/

class UserLimit extends DatabaseObject {

	protected function defineRelationships() {}

	protected function overridePrimaryKeyName() {}


	//returns number of children for this particular contact role
	public function getNumberOfChildren(){

		$query = "SELECT count(*) childCount FROM Resource WHERE userLimitID = '" . $this->userLimitID . "';";

		$result = $this->db->processQuery($query, 'assoc');

		return $result['childCount'];

	}


	//override db object allAsArray for better sort in case numbers are used
	public function allAsArray(){

		$query = "SELECT * FROM `UserLimit` ORDER BY ABS(shortName), userLimitID";
		$result = $this->db->processQuery($query, 'assoc');

		$resultArray = array();
		$rowArray = array();

		if (isset($result['userLimitID'])){
			foreach (array_keys($result) as $attributeName) {
				$rowArray[$attributeName] = $result[$attributeName];
			}
			array_push($resultArray, $rowArray);
		}else{
			foreach ($result as $row) {
				foreach (array_keys($this->attributeNames) as $attributeName) {
					$rowArray[$attributeName] = $row[$attributeName];
				}
				array_push($resultArray, $rowArray);
			}
		}

		return $resultArray;

	}


}

?>
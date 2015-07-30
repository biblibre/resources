<?php

$resourceID = $_GET["resourceID"];

$resource = new Resource(new NamedArguments(array('primaryKey' => $resourceID))); 

$organizationArray = $resource->getOrganizationArray();
$organizationData = $organizationArray[0];

if($organizationData['organizationID']) {
	$organizationContactsArray = $resource->organizationContactsArray($organizationData['organizationID']);
	$organizationResourcesArray = $resource->getSiblingResourcesArray($organizationData['organizationID']);
}

?>

<form id='newIssueForm'>

	<table class="thickboxTable" style="width:98%;background-image:url('images/title.gif');background-repeat:no-repeat;">
		<tr>
			<td colspan="2">
				<h1> Report New Problem</h1>
			</td>
		</tr>
		<tr>
			<td><label>Organization:</label></td>
			<td>
				<p><?php echo $organizationData['organization']; ?></p>
				<span id='span_error_organizationId' class='smallDarkRedText'>
			</td>
		</tr>
		<tr>
			<td><label>Contact:</label></td>
			<td>
				<select multiple style="min-height: 60px;" type='text' id='contactIDs' name='contactIDs[]'>
<?php 

	foreach ($organizationContactsArray as $contact) {
		echo "		<option value=\"{$contact['contactID']}\">{$contact['name']}</option>";
	}

?>
				</select>
				<span id='span_error_contactName' class='smallDarkRedText'>
			</td>
		</tr>
		<tr>
			<td><label>CC myself:</label></td>
			<td>
				<input type='checkbox' id='ccCreator' name='ccCreator' class='changeInput' />
				<span id='span_error_ccCreator' class='smallDarkRedText'>
			</td>
		</tr>
		<tr>
			<td><label>CC:</label></td>
			<td>
				<input type="text" id="inputEmail" name="inputEmail" />
				<input type="button" id="addEmail" name="addEmail" value="Add" />
				<p>
					Current CCs: <span id="currentEmails"></span>
				</p>
				<input type="hidden" id='ccEmails' name='ccEmails' value='' class='changeInput' />
				<span id='span_error_contactIDs' class='smallDarkRedText'>
			</td>
		</tr>
		<tr>
			<td><label>Subject:</label></td>
			<td>
				<input type='text' id='subjectText' name='issue[subjectText]' value='' class='changeInput' />
				<span id='span_error_subjectText' class='smallDarkRedText'>
			</td>
		</tr>
		<tr>
			<td><label>Body:</label></td>
			<td>
				<textarea id='bodyText' name='issue[bodyText]' value='' />
				<span id='span_error_bodyText' class='smallDarkRedText'>
			</td>
		</tr>
		<tr>
			<td><label>Applies to:</label></td>
			<td>
				<div>
					<input type="checkbox" name="issueResources[allResources]" value="1" /> <label for="allResources">Applies to all</label>
				</div>
				<select style="min-height: 140px" multiple id="resourceIDs" name="resourceIDs[]">
<?php
if (!empty($organizationResourcesArray)) {
	foreach ($organizationResourcesArray as $resource) {
		echo "		<option value=\"{$resource['resourceID']}\">{$resource['titleText']}</option>";
	}
}
?>
				</select>
				<span id='span_error_resourceIDs' class='smallDarkRedText'>
			</td>
		</tr>
	</table>

	<p> Send me a reminder every 
		<select name="issue[reminderInterval]">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
		</select> day(s) 
	</p>

	<table class='noBorderTable' style='width:125px;'>
		<tr>
			<td style='text-align:left'><input type='button' value='submit' name='submitNewIssue' id='submitNewIssue'></td>
			<td style='text-align:right'><input type='button' value='cancel' onclick="tb_remove();"></td>
		</tr>
	</table>

</form>



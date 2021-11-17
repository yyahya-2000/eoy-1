<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

$disciplines = [];

if(isset($_GET["group-id"]))
{
	$idGroup = $_GET["group-id"];

	if (!ctype_digit($idGroup))
	{
		die("the id of the group for which should be shown rating is not an integer and the only reason is that you made 
		a change to the url");
	}

	// get all disciplines for specific group
	$disciplinesResult = $communicator->getDisciplinesInGroup($idGroup);

	// build the student rating for specific group
	$studentRating = $communicator->getStudentRatingByGroupID($idGroup);
}

// select all groups
$groups = $communicator->getAllGroups();

require_once $_SERVER['DOCUMENT_ROOT'] . '/studentRating.view.php';
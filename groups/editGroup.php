<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();
$id = $_GET["id"];
if (!ctype_digit($id))
{
	die("the id of the register which should be edited is not an integer and the only reason is that you made 
		a change to the url");
}
// get specific group from db, knowing group id
$group = $communicator->getGroupByID($id);

require_once $_SERVER['DOCUMENT_ROOT'] .'/groups/view/editGroup.view.php';

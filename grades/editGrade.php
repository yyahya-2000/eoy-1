<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();
$id = $_GET["id"];

if (!ctype_digit($id))
{
	die("the id of the register which should be edited is not an integer and the only reason is that you made 
		a change to the url");
}
// get specific grade from db
$grade = $communicator->getGradeByID($id);

require_once $_SERVER['DOCUMENT_ROOT'] .'/grades/view/editGrade.view.php';
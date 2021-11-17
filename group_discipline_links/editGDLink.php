<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();
$idGroup = $_GET["id-group"];
$idDiscipline = $_GET["id-discipline"];

// check the ids passed throw _GET
if (!ctype_digit($idGroup) || !ctype_digit($idDiscipline))
{
	die("the id of the register which should be edited is not an integer and the only reason is that you made 
		a change to the url");
}

// get specific register from group_discipline_links table, knowing id group and id discipline
$gdLink = $communicator->getGroupDisciplineLinkByIDs($idGroup, $idDiscipline);

// get all groups from db
$groups = $communicator->getAllGroups();

// get disciplines from db
$disciplines = $communicator->getAllDisciplines();

require_once $_SERVER['DOCUMENT_ROOT'] .'/group_discipline_links/view/editGDLink.view.php';

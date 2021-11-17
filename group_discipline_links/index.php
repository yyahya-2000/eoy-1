<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();
// add register in group-discipline-Links table
if (isset($_POST['add-g-d-link']))
{
	$disciplineId = $_POST["discipline-id"];
	$groupId = $_POST["group-id"];

	if($communicator->isExitGroupDisciplineLink($groupId, $disciplineId))
	{
		echo "<script>alert('this group discipline connection already exist in database!')</script>";
		echo "<script>location.href='/group_discipline_links/addGDLink.php'</script>";
		exit();
	}

	$communicator->addGroupDisciplineLink($groupId, $disciplineId);
}

// editing register in group-discipline-Links table
if (isset($_POST['edit-g-d-link']))
{
	$idEditedGroup = $_GET["id-group"];
	$idEditedDiscipline = $_GET["id-discipline"];
	$idGroup = $_POST["group-id"];
	$idDiscipline = $_POST["discipline-id"];

	if($communicator->isExitGroupDisciplineLink($idEditedGroup, $idEditedDiscipline))
	{
		echo "<script>alert('this group discipline connection already exist in database!')</script>";
		echo "<script>location.href='/group_discipline_links/editGDLink.php?=id-group=$idGroup&' +
            'id-discipline=$idDiscipline'</script>";
		exit();
	}
	$communicator->updateGroupDisciplineLink($idGroup, $idDiscipline, $idEditedGroup, $idEditedDiscipline);
}

if (isset($_GET["id-group-delete"]) && isset($_GET["id-discipline-delete"]))
{
	if (!ctype_digit($_GET["id-group-delete"]) || !ctype_digit($_GET["id-discipline-delete"]))
	{
		die("the id of the register which should be deleted is not an integer and the only reason is that you made 
		a change to the url");
	}

	$idGroup = $_GET["id-group-delete"];
	$idDiscipline = $_GET["id-discipline-delete"];

	$communicator->deleteGroupDisciplineLink($idGroup, $idDiscipline);
}

// get all group_discipline_links
$gdLinks = $communicator->getAllGroupDisciplineLinks();

require_once $_SERVER['DOCUMENT_ROOT'] .'/group_discipline_links/view/index.view.php';


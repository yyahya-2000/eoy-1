<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

// add register in group table
if (isset($_POST['add-group']))
{
	$groupName = $_POST["groupname"];

	if ($communicator->isExit("groups", "name", $groupName))
	{
		echo "<script>alert('this group name already exist, please choose another one!')</script>";
		echo "<script>location.href='/groups/addGroup.php'</script>";
		exit();
	}

	$communicator->addGroup($groupName);
}

// editing register in group table
if (isset($_POST['edit-group']))
{
	$groupName = $_POST["groupname"];
	$id = $_GET["id"];

	if ($communicator->isExit("groups", "name", $groupName))
	{
		echo "<script>alert('this group name already exist, please choose another one!')</script>";
		echo "<script>location.href='/groups/editGroup.php?id=$id'</script>";
		exit();
	}

	$communicator->updateGroup($id, $groupName);
}
if (isset($_GET["id-delete"]))
{
	if (!ctype_digit($_GET["id-delete"]))
	{
		die("the id of the register which should be deleted is not an integer and the only reason is that you made 
		a change to the url");
	}

	$id = $_GET["id-delete"];

	$communicator->deleteByID("groups", $id);
}


// get all groups from db
$groups = $communicator->getAllGroups();

require_once $_SERVER['DOCUMENT_ROOT'] .'/groups/view/index.view.php';

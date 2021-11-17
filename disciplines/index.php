<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

// add register in discipline table
if (isset($_POST['add-discipline']))
{
	$disciplineName = $_POST["discipline-name"];

	if ($communicator->isExit("disciplines", "name", $disciplineName))
	{
		echo "<script>alert('this discipline name already exist, please choose another one!')</script>";
		//echo "<script>location.href='../disciplines/addDiscipline.php'</script>";
		//exit();
	} else
	{
		$communicator->addDiscipline($disciplineName);
	}
}

// editing register in discipline table
if (isset($_POST['edit-discipline']))
{
	$disciplineName = $_POST["discipline-name"];
	$id = $_GET["id"];
	if ($communicator->isExit("disciplines", "name", $disciplineName))
	{
		echo "<script>alert('this discipline name already exist, please choose another one!')</script>";
		echo "<script>location.href='/disciplines/editDiscipline.php?id=$id'</script>";
		exit();
	} else
	{
		$communicator->updateDiscipline($id, $disciplineName);
	}
}

if (isset($_GET["id-delete"]))
{
	if (!ctype_digit($_GET["id-delete"]))
	{
		die("the id of the register which should be deleted is not an integer and the only reason is that you made 
		a change to the url");
	}

	$id = $_GET["id-delete"];

	$communicator->deleteByID("disciplines", $id);
}

$disciplines = $communicator->getAllDisciplines();

require $_SERVER['DOCUMENT_ROOT'] . '/disciplines/view/index.view.php';

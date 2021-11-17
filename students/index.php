<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

// add register in student table
if (isset($_POST['add-student']))
{
	$studentName = $_POST["student-name"];
	$groupId = $_POST["group-id"];

	if ($communicator->isExit("students", "name", $studentName))
	{
		echo "<script>alert('this student name already exist, please choose another one!')</script>";
		echo "<script>location.href='/students/addStudent.php'</script>";
		exit();
	}
	$communicator->addStudent($groupId, $studentName);
}

// editing register in student table
if (isset($_POST['edit-student']))
{
	$studentName = $_POST["student-name"];
	$idGroup = $_POST["group-id"];
	$id = $_GET["id"];

	if ($communicator->isExit("students", "name", $studentName))
	{
		echo "<script>alert('this student name already exist, please choose another one!')</script>";
		echo "<script>location.href='/students/editStudent.php?id=$id'</script>";
		exit();
	}

	$communicator->updateStudent($id, $idGroup, $studentName);
}
if (isset($_GET["id-delete"]))
{
	if (!ctype_digit($_GET["id-delete"]))
	{
		die("the id of the register which should be deleted is not an integer and the only reason is that you made 
		a change to the url");
	}

	$id = $_GET["id-delete"];

	$communicator->deleteByID("students", $id);
}


// get all students from db
$students = $communicator->getAllStudents();

require_once $_SERVER['DOCUMENT_ROOT'] . '/students/view/index.view.php';

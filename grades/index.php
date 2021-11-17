<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

// add register in grade table
if (isset($_POST['add-grade']))
{
	$disciplineId = $_POST["discipline-id"];
	$studentId = $_POST["student-id"];
	$grade = $_POST["grade"];

	if ($communicator->isGradeExist($disciplineId, $studentId))
	{
		echo "<script>alert('this student already has grade in this discipline!')</script>";
		echo "<script>location.href='/grades/addGrade.php'</script>";
		exit();
	}


	$communicator->addGrade($disciplineId, $studentId, $grade);
}

// editing register in grade table
if (isset($_POST['edit-grade']))
{
	$id = $_GET["id"];
	$grade = $_POST["grade"];
	$idStudent = $_POST["student-id"];
	$idDiscipline = $_POST["discipline-id"];

	if ($communicator->isGradeExistForEdit($idDiscipline, $idStudent, $grade))
	{
		echo "<script>alert('this student already has the same grade in this discipline!')</script>";
		echo "<script>location.href='/grades/editGrad.php?id=$id'</script>";
		exit();
	}

	$communicator->updateGrade($id, $idStudent, $idDiscipline, $grade);
}

if (isset($_GET["id-delete"]))
{
	if (!ctype_digit($_GET["id-delete"]))
	{
		die("the id of the register which should be deleted is not an integer and the only reason is that you made 
		a change to the url");
	}

	$id = $_GET["id-delete"];

	$communicator->deleteByID("grades", $id);
}

$grades = $communicator->getAllGrades();

require_once $_SERVER['DOCUMENT_ROOT'] .'/grades/view/index.view.php';

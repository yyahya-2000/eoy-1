<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

$groupsStudents = $communicator->getStudentsInsideEachGroup();
$groupsDisciplines = $communicator->getDisciplinesInsideEachGroup();

$studentsByGroup = array();
while ($group = mysqli_fetch_array($groupsStudents))
{
	$students = explode(",", $group["students"]);
	foreach ($students as $student)
	{
		$temp = explode("->", $student);
		$studentsByGroup[$group["name"]][] = [$temp[0], $temp[1]];
	}
}

$disciplinesByGroup = array();
while ($group = mysqli_fetch_array($groupsDisciplines))
{
	$disciplines = explode(",", $group["disciplines"]);
	foreach ($disciplines as $discipline)
	{
		$temp = explode("->", $discipline);
		$disciplinesByGroup[$group["name"]][] = [$temp[0], $temp[1]];
	}
}

$groups = $communicator->getAllGroups();

require_once $_SERVER['DOCUMENT_ROOT'] . '/grades/view/addGrade.view.php';
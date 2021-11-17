<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

// get all groups
$groups = $communicator->getAllGroups();

require_once $_SERVER['DOCUMENT_ROOT'] . '/students/view/addStudent.view.php';

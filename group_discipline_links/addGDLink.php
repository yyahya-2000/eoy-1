<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDBCommunicator.php';

$communicator = new CDBCommunicator();

// get all groups from db
$groups = $communicator->getAllGroups();

// get disciplines from db
$disciplines = $communicator->getAllDisciplines();

require_once $_SERVER['DOCUMENT_ROOT'] .'/group_discipline_links/view/addGDLink.view.php';

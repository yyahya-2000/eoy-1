<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CQueryBuilder.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/model/CDB.php';

/**
 * this class is the door for communication between the controller and the model
 *
 * NOTE: The method name shows the behavior and intent of it,
 * so read the names carefully to understand the methods
 */
class CDBCommunicator
{
	private $db;
	private $queryBuilder;

	public function __construct() {
		$this->db = new CDB();
		$this->queryBuilder = new CQueryBuilder();
		$this->db->connect();
	}
	public function __destruct () {
		$this->db->disconnect();
	}

	public function getAllDisciplines()
	{
		$query = $this->queryBuilder->select('*')->from('disciplines')->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getDisciplineByID($id)
	{
		$query = $this->queryBuilder->select('*')->from('disciplines')->where("id='$id'")
			->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_fetch_array($result);
	}

	public function getAllGrades()
	{
		$query = $this->queryBuilder->select("t1.id id", "t1.value grad", "t2.name discipline",
			"t3.name student")->from("grades","t1")
			->join("disciplines","t2")->on("t1.id_descipline = t2.id")
			->join("students","t3")->on("t1.id_student = t3.id")->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getGradeByID($id)
	{
		$query = $this->queryBuilder->select("t1.id id", "t1.value grade", "t2.name discipline",
			"t3.name student")->from("grades","t1")
			->join("disciplines", "t2")->on("t1.id_descipline = t2.id")
			->join("students", "t3")->on("t1.id_student = t3.id")
			->where("t1.id = '$id'")->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_fetch_array($result);
	}

	public function getAllGroups()
	{
		$query = $this->queryBuilder->select("*")->from("groups")->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getGroupDisciplineLinkByIDs($idGroup, $idDiscipline)
	{
		$query = $this->queryBuilder->select("t2.id id_group","t2.name group_","t3.id id_disc",
			"t3.name discipline")->from("group_discipline_links","t1")
			->join("groups", "t2")->on("t1.id_group = t2.id")
			->join("disciplines", "t3")->on("t1.id_discipline = t3.id")
			->where(" id_group = '$idGroup'", "id_discipline = '$idDiscipline'")->fetchQuery();
		$result = $this->db->executeQuery($query);

		return mysqli_fetch_array($result);
	}

	public function getAllGroupDisciplineLinks()
	{
		$query = $this->queryBuilder->select("t2.id id_group","t2.name group_","t3.id id_disc",
			"t3.name discipline")->from("group_discipline_links", "t1")
			->join("groups", "t2")->on("t1.id_group = t2.id")
			->join("disciplines", "t3")->on("t1.id_discipline = t3.id")->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getGroupByID($id)
	{
		$query = $this->queryBuilder->select('*')->from('groups')->where("id='$id'")->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_fetch_array($result);
	}

	public function getAllStudents()
	{
		$query = $this->queryBuilder->select("t1.id as id", "t1.name as name", "t2.name as group_")
			->from('students', "t1")->join("groups", "t2")->on("t1.id_group = t2.id")
			->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getStudentByID($id)
	{
		$query = $this->queryBuilder->select("t1.id as id", "t1.name as name", "t2.name as group_")
			->from('students', "t1")->join("groups", "t2")->on("t1.id_group = t2.id")
			->where("t1.id = '$id'")->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_fetch_array($result);
	}

	public function getDisciplinesInGroup($idGroup)
	{
		$query = $this->queryBuilder->select("DISTINCT d.name")->from("disciplines", "d")
			->join("group_discipline_links", "gdl")->on("gdl.id_discipline = d.id")
			->where("gdl.id_group = '$idGroup'")->orderBy("d.name")->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getStudentRatingByGroupID($idGroup)
	{
		$query = $this->queryBuilder->select("s.name",
			"GROUP_CONCAT(d.name,'->', g.value ORDER BY d.name SEPARATOR ';') grades ")
			->from("students", "s")
			->leftJoin("grades", "g")->on("s.id = g.id_student")
			->leftJoin("disciplines", "d")->on("g.id_descipline = d.id")
			->where("s.id_group = '$idGroup'")->groupBy("s.name")->fetchQuery();
		return $this->db->executeQuery($query);
	}

	/**
	 * check if $columnName = $value exist in $tableName
	 *
	 * @param string $tableName
	 * @param string $columnName
	 * @param $value
	 * @return bool true if $columnName = $value exist in $tableName, false otherwise
	 */
	public function isExit(string $tableName, string $columnName, $value): bool
	{
		$query = $this->queryBuilder->select($columnName)->from($tableName)
			->where("BINARY " . $columnName." = '$value'" )->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_num_rows($result) > 0;
	}

	public function addDiscipline($disciplineName)
	{
		$query = $this->queryBuilder->insertInto("disciplines")->columns("name")
			->values("'$disciplineName'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function updateDiscipline($idDiscipline, $newDisciplineName)
	{
		$query = $this->queryBuilder->update('disciplines')->set("name='$newDisciplineName'")
			->where("id='$idDiscipline'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function isGradeExist($disciplineId, $studentId): bool
	{
		$query = $this->queryBuilder->select("id_descipline", "id_student")->from("grades")->where(
			"BINARY id_descipline = '$disciplineId'" , "BINARY id_student = '$studentId'"  )->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_num_rows($result) > 0;
	}

	public function isGradeExistForEdit($disciplineId, $studentId, $grade): bool
	{
		$query = $this->queryBuilder->select("id_descipline", "id_student")->from("grades")->where(
			"BINARY id_descipline = '$disciplineId'" , "BINARY id_student = '$studentId'",
			"BINARY value = '$grade'" )->fetchQuery();
		$result = $this->db->executeQuery($query);
		return mysqli_num_rows($result) > 0;
	}

	public function addGrade($disciplineId, $studentId, $grade)
	{
		$query = $this->queryBuilder->insertInto("grades")->columns("id_descipline", "id_student",
			"value")->values("'$disciplineId'", "'$studentId'", "'$grade'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function updateGrade($id, $idStudent, $idDiscipline, $grade)
	{
		$query = $this->queryBuilder->update('grades')->set("value='$grade'", "id_student='$idStudent'",
			"id_descipline='$idDiscipline'")->where("id='$id'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function isExitGroupDisciplineLink($groupId, $disciplineId): bool
	{
		$query = $this->queryBuilder->select("id_discipline", "id_group")->from("group_discipline_links")
			->where("BINARY id_discipline = '$disciplineId'" , "BINARY id_group = '$groupId'"  )->fetchQuery();
		$result = $this->db->executeQuery($query);

		return mysqli_num_rows($result) > 0;
	}

	public function addGroupDisciplineLink($groupId, $disciplineId)
	{
		$query = $this->queryBuilder->insertInto("group_discipline_links")->columns("id_discipline",
			"id_group")->values("'$disciplineId'", "'$groupId'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function updateGroupDisciplineLink($idGroup, $idDiscipline, $idEditedGroup, $idEditedDiscipline)
	{
		$query = $this->queryBuilder->update('group_discipline_links')->set("id_group='$idGroup'",
			"id_discipline='$idDiscipline'", "id_descipline='$idDiscipline'")->where("id_group='$idEditedGroup'",
			"id_discipline='$idEditedDiscipline'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function addGroup($groupName)
	{
		$query = $this->queryBuilder->insertInto("groups")->columns("name")->values("'$groupName'")
			->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function updateGroup($id, $groupName)
	{
		$query = $this->queryBuilder->update('groups')->set("name='$groupName'")->where("id='$id'")
			->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function addStudent($groupId, $studentName)
	{
		$query = $this->queryBuilder->insertInto("students")->columns("name", "id_group")
			->values("'$studentName'", "'$groupId'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function updateStudent($id, $idGroup, $studentName)
	{
		$query = $this->queryBuilder->update('students')->set("name='$studentName'", "id_group='$idGroup'")
			->where("id='$id'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function deleteByID($tableName, $id)
	{
		$query = $this->queryBuilder->deleteFrom($tableName)->where("id = '$id'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function deleteGroupDisciplineLink($idGroup, $idDiscipline)
	{
		$query = $this->queryBuilder->deleteFrom("group_discipline_links")->
		where("id_discipline = '$idDiscipline'", "id_group = '$idGroup'")->fetchQuery();
		$this->db->executeQuery($query);
	}

	public function getStudentsInsideEachGroup()
	{
		$query = $this->queryBuilder->select("g.name","GROUP_CONCAT(s.id,'->',s.name) students" )
			->from("groups", "g")->join("students", "s")->on("s.id_group = g.id")
			->groupBy("g.name")->fetchQuery();
		return $this->db->executeQuery($query);
	}

	public function getDisciplinesInsideEachGroup()
	{
		$query = $this->queryBuilder->select("g.name", "GROUP_CONCAT(d.id, '->', d.name) disciplines")
			->from("groups", "g")
			->join("group_discipline_links", "gdl")->on("gdl.id_group = g.id")
			->join("disciplines", "d")->on("d.id = gdl.id_discipline")
			->groupBy("g.name")->fetchQuery();
		return $this->db->executeQuery($query);
	}
}
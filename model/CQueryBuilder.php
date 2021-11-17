<?php

class CQueryBuilder
{
	/**
	 * @var string
	 */
	private $sqlQuery = "";

	/**
	 * fetch collected query
	 *
	 * @return string query
	 */
	public function fetchQuery(): string
	{
		return $this->sqlQuery;
	}

	/**
	 * Initialize sqlQuery with select statement
	 *
	 * @param string ...$select columns to be selected
	 * @return $this The reference of the object that called this function
	 */
	public function select(string ...$select): self
	{
		$this->sqlQuery = 'SELECT ' . implode(', ', $select);
		return $this;
	}

	/**
	 * Add FROM statement to sqlQuery
	 *
	 * @param string $table table name
	 * @param string|null $alias table nickname
	 * @return $this The reference of the object that called this function
	 */
	public function from(string $table, ?string $alias = null): self
	{
		if ($alias === null)
		{
			$this->sqlQuery .= ' FROM ' . $table;
		} else
		{
			$this->sqlQuery .= ' FROM ' . "${table} AS ${alias}";
		}

		return $this;
	}

	/**
	 * Add Conditions to sqlQuery
	 *
	 * @param string ...$where conditions
	 * @return $this The reference of the object that called this function
	 */
	public function where(string ...$where): self
	{
		$this->sqlQuery .= $where === [] ? '' : ' WHERE ' . implode(' AND ', $where);
		return $this;
	}

	/**
	 * Add join conditions to sqlQuery
	 *
	 * @param string ...$on conditions of join
	 * @return $this The reference of the object that called this function
	 */
	public function on(string ...$on): self
	{
		$this->sqlQuery .= $on === [] ? '' : ' ON ' . implode(' AND ', $on);
		return $this;
	}

	/**
	 * Add join statement to sqlQuery
	 *
	 * @param string $table table name
	 * @param string|null $alias table nickname
	 * @return $this The reference of the object that called this function
	 */
	public function join(string $table, ?string $alias = null): self
	{
		if ($alias === null)
		{
			$this->sqlQuery .= ' JOIN ' . $table;;
		} else
		{
			$this->sqlQuery .= ' JOIN ' . "${table} AS ${alias}";
		}

		return $this;
	}

	/**
	 * Add left join statement to sqlQuery
	 *
	 * @param string $table table name
	 * @param string|null $alias table nickname
	 * @return $this The reference of the object that called this function
	 */
	public function leftJoin(string $table, ?string $alias = null): self
	{
		if ($alias === null)
		{
			$this->sqlQuery .= ' LEFT JOIN ' . $table;;
		} else
		{
			$this->sqlQuery .= ' LEFT JOIN ' . "${table} AS ${alias}";
		}

		return $this;
	}

	/**
	 * Add delete statement to sqlQuery
	 *
	 * @param string $table table name
	 * @return $this The reference of the object that called this function
	 */
	public function deleteFrom(string $table): self
	{
		$this->sqlQuery = 'DELETE FROM ' . $table;
		return $this;
	}

	/**
	 * Add update statement to sqlQuery
	 *
	 * @param string $table table name
	 * @return $this The reference of the object that called this function
	 */
	public function update(string $table): self
	{
		$this->sqlQuery = 'UPDATE ' . $table;
		return $this;
	}

	/**
	 * Add set statement to sqlQuery
	 *
	 * @param string ...$fields column names with values
	 * @return $this The reference of the object that called this function
	 */
	public function set(string ...$fields): self
	{
		$this->sqlQuery .= ' SET ' . implode(', ', $fields);
		return $this;
	}

	/**
	 * Add insert statement with table name to sqlQuery
	 *
	 * @param string $table table name
	 * @return $this The reference of the object that called this function
	 */
	public function insertInto(string $table): self
	{
		$this->sqlQuery = 'INSERT INTO ' . $table;
		return $this;
	}

	/**
	 * Add column names for inserting to sql query
	 *
	 * @param string ...$columns column names
	 * @return $this The reference of the object that called this function
	 */
	public function columns(string ...$columns): self
	{
		$this->sqlQuery .= ' (' . implode(', ', $columns) . ')';
		return $this;
	}

	/**
	 * Add column values for inserting to sqlQuery
	 *
	 * @param string ...$values column values
	 * @return $this The reference of the object that called this function
	 */
	public function values(string ...$values): self
	{
		$this->sqlQuery .= " VALUES(" . implode(', ', $values) . ')';
		return $this;
	}

	/**
	 * Add order by statement to sql query
	 *
	 * @param string ...$byWhat columns by which the sorting will be executed
	 * @return $this The reference of the object that called this function
	 */
	public function orderBy(string ...$byWhat): self
	{
		$this->sqlQuery .= " ORDER BY " . implode(', ', $byWhat);
		return $this;
	}

	/**
	 * Add group by statement to sql query
	 *
	 * @param string ...$byWhat columns by which the grouping will be executed
	 * @return $this The reference of the object that called this function
	 */
	public function groupBy(string ...$byWhat): self
	{
		$this->sqlQuery .= " GROUP BY " . implode(', ', $byWhat);
		return $this;
	}
}
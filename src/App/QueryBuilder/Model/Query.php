<?php

namespace App\QueryBuilder\Model;

class Query
{
    /**
     * @var array
     */
    protected $query = [
        'select' => "",
        'table' => "",
        'join' => "",
        'where' => "",
        'groupBy' => "",
        'orderBy' => "",
        'limit' => ""
    ];

    /**
     * @var string
     */
    protected $queryString = "";

    /**
     * @var array
     */
    protected $union = [];

    /**
     * @var bool
     */
    public $paginate = false;

    /**
     * Method to generate the base format of `WHERE` query
     * 
     * @return string
     */
    protected function generateWhere()
    {
        $param = func_get_args()[0];

        if (count(explode(".", $param[0])) > 1) {
            $column = "" . explode(".", $param[0])[0] . "." . explode(".", $param[0])[1] . "";
        } else {
            $column = "" . $param[0] . "";
        }

        if (count($param) == 3) {
            $where = $this->query['where'] . $column . " " . $param[1] . " '" . $param[2] . "'";
        } else {
            $where = $this->query['where'] . $column . " = '" . $param[1] . "'";
        }
        $this->query['where'] = $where;

        return $where;
    }

    /**
     * Method to make the `SELECT` part of the query
     * 
     * @param string
     * @return QueryBuilder
     */
    public function select($select)
    {
        $param = func_get_args();

        foreach ($param as $key => $value) {
            if ($key == 0) {
                $this->query['select'] .= "";
            } else {
                $this->query['select'] .= ", ";
            }

            $column = explode(" as ", $value);
            if (count(explode(" as ", $value)) > 1) {
                $column = "" . $column[0] . " as " . $column[1] . "";
            } else {
                $column = "" . $column[0] . "";
            }

            if (count(explode(".", $column)) > 1) {
                $column = explode(".", $column)[0] . "." . explode(".", $column)[1];
            } else {
                $column = $column;
            }

            $this->query['select'] .= $column;
        }

        $this->generateSql();

        return $this;
    }

    /**
     * Method to generate the `WHERE` part of the query with group
     */
    public function whereGroup()
    {
        $param = func_get_args();
        $statusObject = ['object' => false, 'empty' => false];

        if (gettype($param[0]) == 'object') {
            $statusObject['object'] = true;

            if ($this->query['where'] == "") {
                $this->query['where'] = " WHERE ";
            } elseif ($this->query['where'] == " WHERE " || substr($this->query['where'], -1) == "(") {
                $this->query['where'] .= "";
            } else {
                $this->query['where'] .= " " . $param[1] . " ";
            }
            $this->query['where'] .= "(";
            $param[0]($this);
            $this->query['where'] .= ")";

            $karakter_terakhir = substr($this->query['where'], -2);

            if (strpos($karakter_terakhir, '()') !== false) {
                $statusObject['empty'] = true;
                $this->query['where'] = explode($karakter_terakhir, $this->query['where'])[0];
            }
        }

        $this->generateSql();

        return $statusObject;
    }

    /**
     * Method to make the `WHERE` part of the query,
     * this method can generate the where query with or without `AND` operator
     * 
     * @return QueryBuilder
     */
    public function where()
    {
        $param = func_get_args();

        $whereGroup = $this->whereGroup($param[0], 'AND');

        if ($this->query['where'] == "") {
            $this->query['where'] = " WHERE ";
        } elseif ((gettype($param[0]) == 'object' && (substr($this->query['where'], -1) == "(" || substr($this->query['where'], -1) == ")")) || (gettype($param[0]) != 'object' && substr($this->query['where'], -1) == "(") || ($whereGroup['object'] && $whereGroup['empty'])) {
            $this->query['where'] .= "";
        } else {
            $this->query['where'] .= " AND ";
        }

        if (gettype($param[0]) != 'object') {
            $this->generateWhere($param);
        }

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `WHERE` part of the query,
     * this method generate the where query with `OR` operator
     * 
     * @return QueryBuilder
     */
    public function orWhere()
    {
        $param = func_get_args();

        $this->whereGroup($param[0], 'OR');

        if ($this->query['where'] == "") {
            die("Cannot use 'OR' statement");
        } elseif ((gettype($param[0]) == 'object' && (substr($this->query['where'], -1) == "(" || substr($this->query['where'], -1) == ")")) || (gettype($param[0]) != 'object' && substr($this->query['where'], -1) == "(")) {
            $this->query['where'] .= "";
        } else {
            $this->query['where'] .= " OR ";
        }

        if (gettype($param[0]) != 'object') {
            $this->generateWhere($param);
        }

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `ORDER BY` part of the query
     * 
     * @return QueryBuilder
     */
    public function orderBy(string $column, string $type = "ASC")
    {
        if ($this->query['orderBy'] == "") {
            $this->query['orderBy'] = " ORDER BY ";
        } else {
            $this->query['orderBy'] .= ", ";
        }

        if (count(explode(".", $column)) > 1) {
            $column = "" . explode(".", $column)[0] . "." . explode(".", $column)[1] . "";
        } else {
            $column = "" . $column . "";
        }

        $this->query['orderBy'] .= $column . " " . $type;

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `LIMIT` and `OFFSET` part of the query
     * 
     * @return QueryBuilder
     */
    public function limit(int $limit, int $offset = 0)
    {
        $this->query['limit'] = " LIMIT ";
        $this->query['limit'] .= $limit;
        $this->query['limit'] .= " OFFSET " . $offset;

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `JOIN` part of the query
     * 
     * @return QueryBuilder
     */
    protected function join(string $joinType, string $table, string $onColumn, string $onColumnOperator, string $onValue)
    {
        $this->query['join'] .= " $joinType JOIN ";
        $this->query['join'] .= "" . $table . " ON ";
        $onColumn = "" . explode(".", $onColumn)[0] . "." . explode(".", $onColumn)[1] . "";
        $onValue = "" . explode(".", $onValue)[0] . "." . explode(".", $onValue)[1] . "";
        $this->query['join'] .= $onColumn . " " . $onColumnOperator . " " . $onValue;
    }

    /**
     * Method to make the `LEFT JOIN` part of the query
     * 
     * @return QueryBuilder
     */
    public function leftJoin(string $table, string $onColumn, string $onColumnOperator, string $onValue)
    {
        $this->join('LEFT', $table, $onColumn, $onColumnOperator, $onValue);

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `RIGHT JOIN` part of the query
     * 
     * @return QueryBuilder
     */
    public function rightJoin(string $table, string $onColumn, string $onColumnOperator, string $onValue)
    {
        $this->join('RIGHT', $table, $onColumn, $onColumnOperator, $onValue);

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `INNER JOIN` part of the query
     * 
     * @return QueryBuilder
     */
    public function innerJoin(string $table, string $onColumn, string $onColumnOperator, string $onValue)
    {
        $this->join('INNER', $table, $onColumn, $onColumnOperator, $onValue);

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `OUTER JOIN` part of the query
     * 
     * @return QueryBuilder
     */
    public function outerJoin(string $table, string $onColumn, string $onColumnOperator, string $onValue)
    {
        $this->join('OUTER', $table, $onColumn, $onColumnOperator, $onValue);

        $this->generateSql();

        return $this;
    }

    /**
     * Method to make the `GROUP BY` part of the query
     * 
     * @return QueryBuilder
     */
    public function groupBy(string $column)
    {
        $param = func_get_args();

        foreach ($param as $key => $value) {
            if ($this->query['groupBy'] == "") {
                $this->query['groupBy'] = " GROUP BY ";
            } else {
                $this->query['groupBy'] .= ", ";
            }

            if (count(explode(".", $value)) > 1) {
                $column = "" . explode(".", $value)[0] . "." . explode(".", $value)[1] . "";
            } else {
                $column = "" . $value . "";
            }

            $this->query['groupBy'] .= $column;
        }

        $this->generateSql();

        return $this;
    }

    /**
     * Method to combine each part of the query
     */
    public function generateSql()
    {
        $this->sql = '';
        if (!isset($this->table)) {
            echo "There is no <b>\$table</b> property in <b>" . get_class($this) . "</b>";
            die();
        }

        if (isset($this->table) && $this->table == '') {
            echo "The <b>\$table</b> property must be filled with Model table name in <b>" . get_class($this) . "</b>";
            die();
        }

        $this->query['table'] = "" . $this->table . "";

        $sql = 'SELECT ';
        $sql .= $this->query['select'] == '' ? "*" : "";
        $this->sql .= $sql;

        if ($this->query['where'] == ' WHERE ') {
            $this->query['where'] = '';
        }

        foreach ($this->query as $key => $value) {
            if ($key != 'limit') {
                if ($key == 'table') {
                    $this->sql .= " FROM ";
                }
                $this->sql .= $value;
            }
        }

        if (strpos(substr($this->sql, -7), "WHERE") !== false) {
            $this->sql = substr($this->sql, 0, -7);
        } else if (strpos(substr($this->sql, -5), "AND") !== false) {
            $this->sql = substr($this->sql, 0, -5);
        } else if (strpos(substr($this->sql, -4), "OR") !== false) {
            $this->sql = substr($this->sql, 0, -4);
        }

        if (!empty($this->union)) {
            foreach ($this->union as $key => $value) {
                $this->sql .= ' UNION ' . $value;
            }
        }

        $this->sql .= $this->query['limit'];
    }

    /**
     * Method to clear query statement
     */
    public function clearQuery()
    {
        $this->sql = "";
        if ($this->clearQuery) {
            foreach ($this->query as $key => $value) {
                $this->query[$key] = "";
            }
        }
    }

    /**
     * @return array
     */
    public function exec_get_all()
    {
        $query = $this->conn->prepare($this->sql);
        $query->execute();
        $this->err_query($query);

        $datas = $query->fetchAll();
        $this->clearQuery();

        return $datas;
    }

    /**
     * @return array
     */
    public function exec_get_one()
    {
        $query = $this->conn->prepare($this->sql);
        $query->execute();
        $this->err_query($query);

        $datas = $query->fetch();
        $this->clearQuery();

        return $datas;
    }

    /**
     * @return ModelCollection
     */
    public function to_model_collection()
    {
        $param = func_get_args();
        $modelCollection = new ModelCollection;
        $modelCollection->items = $param[0];

        if (isset($param[1])) {
            $paginator = new Paginator;
            $paginator->setProp($param[1]);
            $modelCollection->pagination = $paginator;
        }

        return $modelCollection;
    }

    public function to_paginator()
    {
        $param = func_get_args();
        $paginator = new Paginator;
        $paginator->setProp($param[1]);
        $paginator->setItems($param[0]->items);

        return $paginator;
    }

    /**
     * Method to generate error message of the query
     */
    public function err_query($query, $indexErr = 2)
    {
        if (!$query) {
            $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
            $file_location = '<br><b>' . $backtrace[$indexErr]['file'] . '</b> on line <b>' . $backtrace[$indexErr]['line'] . '</b>';
            echo '<br>' . mysqli_error($this->conn) . ' in ' . $file_location;
            die();
        }
    }

    /**
     * Method to add query string
     * 
     * @return Paginator
     */
    public function appends(array $datas)
    {
        $queryString = '';
        foreach ($datas as $key => $value) {
            $queryString .= $key > 0 ? '&' : '';
            $queryString .= $key . '=' . $value;
        }

        $this->queryString = $queryString;

        return $this;
    }

    /**
     * Method to get list of table columns
     * 
     * @param string $table
     * @return array
     */
    public function getTableColumn(string $table)
    {
        $sql = "DESC $table";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $this->err_query($query);

        $tableColumn = [];
        $primaryKey = '';

        $datas = $query->fetchAll();
        foreach ($datas as $key => $value) {
            $tableColumn[$value['Field']] = null;
            if ($value['Key'] == 'PRI') {
                $primaryKey = $value['Field'];
            }
        }

        if ($primaryKey == '') {
            echo "There is no primary key in <b>$table</b>";
            dd();
        }

        return ['column' => $tableColumn, 'primaryKey' => $primaryKey];
    }

    /**
     * Method to make `INSERT` query
     * 
     * @param array $datas
     * @return string $sql
     */
    public function insertQuery(array $datas)
    {
        $tableColumn = $this->getTableColumn($this->table);
        $sql = "INSERT INTO " . $this->table . " VALUES ";

        if (isset($datas[0])) {
            $primaryKey = [];
            $datasQuery = [];

            foreach ($datas as $key => $value) {
                $datasQuery[$key] = $tableColumn['column'];
                foreach ($datasQuery[$key] as $key1 => $value1) {
                    if ($key1 != $tableColumn['primaryKey']) {
                        $datasQuery[$key][$key1] = isset($value[$key1]) ? $value[$key1] : null;
                    } else {
                        if (isset($value[$tableColumn['primaryKey']])) {
                            $datasQuery[$key][$tableColumn['primaryKey']] = $value[$key1];
                        } else {
                            $datasQuery[$key][$tableColumn['primaryKey']] = uniqid();
                        }
                        array_push($primaryKey, $datasQuery[$key][$tableColumn['primaryKey']]);
                    }
                }
                $datasQuery[$key]['created_at'] = date('Y-m-d H:i:s');
                $datasQuery[$key]['updated_at'] = date('Y-m-d H:i:s');
            }

            foreach ($datasQuery as $key => $value) {
                $sql .= "(";
                foreach ($value as $item) {
                    $sql .= $item == null ? "NULL, " : "\"" . $item . "\", ";
                }
                $sql = substr($sql, 0, -2);
                $sql .= "), ";
            }
            $sql = substr($sql, 0, -2);
        } else {
            $primaryKey = '';
            $datas['created_at'] = date('Y-m-d H:i:s');
            $datas['updated_at'] = date('Y-m-d H:i:s');

            foreach ($tableColumn['column'] as $key => $value) {
                if ($key != $tableColumn['primaryKey']) {
                    $tableColumn['column'][$key] = isset($datas[$key]) ? $datas[$key] : null;
                } else {
                    if (isset($datas[$tableColumn['primaryKey']])) {
                        $tableColumn['column'][$tableColumn['primaryKey']] = $datas[$key];
                    } else {
                        $tableColumn['column'][$tableColumn['primaryKey']] = uniqid();
                    }
                    $primaryKey = $tableColumn['column'][$tableColumn['primaryKey']];
                }
            }

            $sql .= "(";
            foreach ($tableColumn['column'] as $key => $value) {
                $sql .= $value == null ? "NULL, " : "\"" . $value . "\", ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= ")";
        }

        return ['sql' => $sql, 'primaryKey' => $primaryKey];
    }

    public function updateQuery(array $datas)
    {
        $tableColumn = $this->getTableColumn($this->table);
        $sql = "UPDATE " . $this->table . " SET ";

        $form_data = [];
        foreach ($datas as $key => $value) {
            foreach ($tableColumn['column'] as $key1 => $value1) {
                if ($key == $key1) {
                    $form_data[$key] = $value;
                }
            }
        }

        foreach ($form_data as $key => $value) {
            if ($key != $tableColumn['primaryKey']) {
                $sql .= $key . " = " . ($value == null ? "NULL, " : "'" . $value . "', ");
            }
        }
        $sql = substr($sql, 0, -2);
        $sql .= $this->query['where'];

        return $sql;
    }

    public function deleteQuery()
    {
        $sql = "DELETE FROM " . $this->table . $this->query['where'];

        return $sql;
    }

    public function sqlExecute($sql)
    {
        $query = $this->conn->prepare($sql);
        $query->execute();
        $this->err_query($query);
        $this->clearQuery();

        return $query->rowCount();
    }

    public function columnExists(string $column)
    {
        $tableColumn = $this->getTableColumn($this->table);

        return array_key_exists($column, $tableColumn['column']);
    }

    public function union(QueryBuilder $query)
    {
        $this->union[] = $query->sql;

        $this->generateSql();

        return $this;
    }

    public function whereNull(string $column)
    {
        if ($this->query['where'] == "") {
            $this->query['where'] = " WHERE ";
        } elseif (((substr($this->query['where'], -1) == "(" || substr($this->query['where'], -1) == ")")) || (substr($this->query['where'], -1) == "(")) {
            $this->query['where'] .= "";
        } else {
            $this->query['where'] .= " AND ";
        }

        $this->query['where'] .= "$column IS NULL";

        $this->generateSql();

        return $this;
    }

    public function orWhereNull(string $column)
    {
        if ($this->query['where'] == "") {
            $this->query['where'] = " WHERE ";
        } elseif (((substr($this->query['where'], -1) == "(" || substr($this->query['where'], -1) == ")")) || (substr($this->query['where'], -1) == "(")) {
            $this->query['where'] .= "";
        } else {
            $this->query['where'] .= " OR ";
        }

        $this->query['where'] .= "$column IS NULL";

        $this->generateSql();

        return $this;
    }
}

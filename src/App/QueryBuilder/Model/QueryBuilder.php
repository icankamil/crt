<?php

namespace App\QueryBuilder\Model;

use App\QueryBuilder\Model\Query;
use Core\Database;

class QueryBuilder extends Query
{
    /**
     * @var string
     */
    protected $sql = '';
    protected $conn;
    protected $connection = 'mysql';
    protected $clearQuery = true;

    public function __construct()
    {
        $db = new Database($this->connection);
        $this->conn = $db->conn;
    }

    /**
     * @return ModelCollection
     */
    public function get()
    {
        $this->generateSql();
        // dd($this->sql);
        $modelCollection = $this->to_model_collection($this->exec_get_all());

        return $modelCollection;
    }

    /**
     * @return array
     */
    public function first()
    {
        $this->generateSql();
        // $modelCollection = $this->to_model_collection($this->exec_get_one());

        // return $modelCollection;
        return $this->exec_get_one();
    }

    /**
     * @return int
     */
    public function count()
    {
        $this->query['table'] = "" . $this->table . "";

        // $this->sql = "SELECT COUNT(*) AS count";
        // foreach ($this->query as $key => $value) {
        //     if ($key == 'table') {
        //         $this->sql .= " FROM ";
        //     }
        //     if ($key != 'select') {
        //         $this->sql .= $value;
        //     }
        // }

        $this->sql = "";
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
        // dd($this->sql);

        return count($this->exec_get_all());
    }

    /**
     * @param int $result_per_page
     * @return QueryBuilder
     */
    public function paginate(int $result_per_page)
    {
        $this->clearQuery = false;

        $page = !isset($_REQUEST['page']) || $_REQUEST['page'] == null ? 1 : $_REQUEST['page'];
        // $countRows = $this->count()['count'];
        $countRows = $this->count();
        $page_first_result = ($page - 1) * $result_per_page;
        $number_of_page = ceil($countRows / $result_per_page);

        $datas = $this->limit($result_per_page, $page_first_result)->get();

        $pagination = [
            'current_page' => intval($page),
            'number_of_page' => intval($number_of_page),
            'page_first_result' => $page_first_result,
            'result_per_page' => $result_per_page,
            'countRows' => intval($countRows),
            'total_data_per_page' => ($result_per_page * ($page - 1)) + count($datas->items)
        ];

        $paginator = $this->to_paginator($datas, $pagination);
        $this->clearQuery = true;
        $this->clearQuery();

        return $paginator;
    }

    public function insert(array $datas)
    {
        $sql = $this->insertQuery($datas);
        $result = $this->sqlExecute($sql['sql']);

        return $result > 0 ? $sql['primaryKey'] : false;
    }

    public function update(array $datas)
    {
        $sql = $this->updateQuery($datas);
        $result = $this->sqlExecute($sql);

        return $result > 0 ? $result : false;
    }

    public function delete()
    {
        $sql = $this->deleteQuery();
        $result = $this->sqlExecute($sql);

        return $result > 0 ? $result : false;
    }
}

<?php

require_once (APP_DIR . '/lib/medoo/medoo.min.php');

/**
 *
 */
class AppJdbcTemplateMedooImpl implements InterfaceJdbcTemplate {

    private $databaseObject;
    private $tablePrefix;

    function __construct(DatabaseConnectionModel $databaseConnectionModel, $tablePrefix) {
        $this->tablePrefix = $tablePrefix;
        $this->databaseObject = new medoo(array(
            // required
            'database_type' => $databaseConnectionModel->getType(), 'database_name' => $databaseConnectionModel->getDatabaseName(), 'server' => $databaseConnectionModel->getServer(), 'username' => $databaseConnectionModel->getUser(), 'password' => $databaseConnectionModel->getPassword(),
            // optional
            'charset' => 'utf8',
            // driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
            'option' => array(PDO::ATTR_CASE => PDO::CASE_NATURAL)));
    }

    function insert($tableName, $keyValueArray) {
        return $this->databaseObject->insert($this->tablePrefix . $tableName, $keyValueArray);
    }

    function update($tableName, $keyValueArray, $whereKeyValueArray) {
        return $this->databaseObject->update($this->tablePrefix . $tableName, $keyValueArray, $whereKeyValueArray);
    }

    function delete($tableName, $whereKeyValueArray) {
        return $this->databaseObject->delete($this->tablePrefix . $tableName, $whereKeyValueArray);
    }

    function selectColumn($tableName, $columns, $order = null, $limit = -1) {
        $result = null;
        $whereKeyValueArray = $this->whereClause(array(), $order, $limit);
        if (count($whereKeyValueArray) > 0) {
            $result = $this->databaseObject->select($this->tablePrefix . $tableName, $columns, $whereKeyValueArray);
        } else {
            $result = $this->databaseObject->select($this->tablePrefix . $tableName, $columns);
        }
        return $result;
    }

    function selectColumnJoin($tableName, $columns, $joins, $order = null, $limit = -1) {
        $result = null;
        if (is_array($joins) && count($joins) > 0) {
            $whereKeyValueArray = $this->whereClause(array(), $order, $limit);
            if (count($whereKeyValueArray) > 0) {
                $result = $this->databaseObject->select($this->tablePrefix . $tableName, $joins, $columns, $whereKeyValueArray);
            } else {
                $result = $this->databaseObject->select($this->tablePrefix . $tableName, $joins, $columns);
            }
        } else {
            $result = $this->selectColumn($this->tablePrefix . $tableName, $columns, $order, $limit);
        }
        return $result;
    }

    function selectColumnConditions($tableName, $columns, $whereKeyValueArray, $joins = null, $order = null, $limit = -1) {
        $result = null;
        $whereKeyValueArray = $this->whereClause($whereKeyValueArray, $order, $limit);
        if (is_array($joins) && count($joins) > 0) {
            $result = $this->databaseObject->select($this->tablePrefix . $tableName, $joins, $columns, $whereKeyValueArray);
        } else {
            $result = $this->databaseObject->select($this->tablePrefix . $tableName, $columns, $whereKeyValueArray);
        }
        return $result;
    }

    function selectMax($tableName, $column, $whereKeyValueArray = null) {
        $result = null;
        if (!empty($whereKeyValueArray)) {
            $result = $this->databaseObject->max($this->tablePrefix . $tableName, $columns, $whereKeyValueArray);
        } else {
            $result = $this->databaseObject->max($this->tablePrefix . $tableName, $columns);
        }
        return $result;
    }

    function selectMin($tableName, $column, $whereKeyValueArray = null) {
        $result = null;
        if (!empty($whereKeyValueArray)) {
            $result = $this->databaseObject->min($this->tablePrefix . $tableName, $column, $whereKeyValueArray);
        } else {
            $result = $this->databaseObject->min($this->tablePrefix . $tableName, $column);
        }
        return $result;
    }

    function selectCount($tableName, $whereKeyValueArray = null) {
        $result = null;
        if (!empty($whereKeyValueArray)) {
            $result = $this->databaseObject->count($this->tablePrefix . $tableName, $whereKeyValueArray);
        } else {
            $result = $this->databaseObject->count($this->tablePrefix . $tableName);
        }
        return $result;
    }

    function getByUnique($tableName, $columns, $whereKeyValueArray = null) {
        $result = null;
        if (!empty($whereKeyValueArray)) {
            $result = $this->databaseObject->get($this->tablePrefix . $tableName, $columns, $whereKeyValueArray);
        } else {
            $result = $this->databaseObject->get($this->tablePrefix . $tableName, $columns);
        }
        return $result;
    }

    function isTrue($tableName, $whereKeyValueArray) {
        return $this->databaseObject->has($this->tablePrefix . $tableName, $whereKeyValueArray);
    }

    private function whereClause($whereKeyValueArray, $order, $limit) {
        if (!empty($order)) {
            $whereKeyValueArray["ORDER"] = $order;
        }
        if (!empty($limit) && $limit != -1) {
            $whereKeyValueArray["LIMIT"] = $order;
        }
        return $whereKeyValueArray;
    }

    function leftJoin($joinTableName, $joinTableColumn, $tableColumn) {
        return join("<", $joinTableName, $joinTableColumn, $tableColumn);
    }

    function rightJoin($joinTableName, $joinTableColumn, $tableColumn) {
        return join(">", $joinTableName, $joinTableColumn, $tableColumn);
    }

    function fullJoin($joinTableName, $joinTableColumn, $tableColumn) {
        return join("<>", $joinTableName, $joinTableColumn, $tableColumn);
    }

    function innerJoin($joinTableName, $joinTableColumn, $tableColumn) {
        return join("><", $joinTableName, $joinTableColumn, $tableColumn);
    }

    private function join($sign, $joinTableName, $joinTableColumn, $tableColumn) {
        return array("[" . $sign . "]" . $tableName => array($tableColumn => $joinTableColumn));
    }

}

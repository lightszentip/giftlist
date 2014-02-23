<?php

/**
 *
 */
interface InterfaceJdbcTemplate {

    function insert($tableName, $keyValueArray);

    function update($tableName, $keyValueArray, $whereKeyValueArray);

    function delete($tableName, $whereKeyValueArray);

    function selectColumn($tableName, $columns, $order = null, $limit = -1);

    function selectColumnJoin($tableName, $columns, $joins, $order = null, $limit = -1);

    function selectColumnConditions($tableName, $columns, $whereKeyValueArray, $joins = null, $order = null, $limit = -1);

    function selectMax($tableName, $column, $whereKeyValueArray = null);

    function selectMin($tableName, $column, $whereKeyValueArray = null);

    function selectCount($tableName, $whereKeyValueArray = null);

    function getByUnique($tableName, $columns, $whereKeyValueArray = null);

    function isTrue($tableName, $whereKeyValueArray);

    function leftJoin($joinTableName, $joinTableColumn, $tableColumn);

    function rightJoin($joinTableName, $joinTableColumn, $tableColumn);

    function fullJoin($joinTableName, $joinTableColumn, $tableColumn);

    function innerJoin($joinTableName, $joinTableColumn, $tableColumn);
}

?>
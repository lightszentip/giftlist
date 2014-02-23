<?php

/**
 *
 */
class ConfigDao {

    private $jdbcTemplate;
    private $tableName = "present_config";
    private $allColumns = array(self::COLUMN_ID,self::COLUMN_KEY,self::COLUMN_VALUE);
    
    const COLUMN_ID = "idpresent_config";
    const COLUMN_KEY = "key";
    const COLUMN_VALUE = "value";

    function __construct(InterfaceJdbcTemplate $jdbcTemplate) {
        $this -> jdbcTemplate = $jdbcTemplate;
    }

    public function getAll() {
        $tableDatas = $this -> jdbcTemplate -> selectColumn($this -> tableName, $this->allColumns);
        $conf = array();
        foreach ($tableDatas as $data) {
            $conf[$data["key"]] = $data["value"];
        }
        return $conf;
    }
    
    public function getByKey($key) {
        return $this -> jdbcTemplate ->getByUnique($this->tableName, self::COLUMN_VALUE, array(self::COLUMN_KEY => $key));
    }
    
    public function update($key,$value) {       
        if($this -> jdbcTemplate -> isTrue($this->tableName, array(self::COLUMN_KEY => "$key"))) {
          $data = $this -> jdbcTemplate ->update($this->tableName, array(self::COLUMN_VALUE => $value), array(self::COLUMN_KEY => $key));
        } else {
            $id = $this -> jdbcTemplate ->insert($this->tableName, array(self::COLUMN_VALUE => $value,self::COLUMN_KEY => $key));
        }
        return true;
    }

}
?>
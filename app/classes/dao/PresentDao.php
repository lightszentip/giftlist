<?php

/**
 *
 */
class PresentDao {

    private $jdbcTemplate;
    private $tableName = "presententries";
    private $allColumns = array(self::COLUMN_ID,self::COLUMN_TITLE,self::COLUMN_DESCRIPTION,self::COLUMN_CODE,self::COLUMN_IMAGEPATH,self::COLUMN_STATUS, self::COLUMN_LINKS);
    
    const COLUMN_ID = "id";
    const COLUMN_TITLE = "title";
    const COLUMN_DESCRIPTION = "description";
    const COLUMN_CODE = "code";
    const COLUMN_IMAGEPATH = "imagepath";
    const COLUMN_STATUS = "status";
    const COLUMN_LINKS = "links";
    const COLUMN_EDIT_DATE = "udat";
    
    const PRESENT_STATUS_USE = 1;
    const PRESENT_STATUS_NOTUSE = 0;

    function __construct(InterfaceJdbcTemplate $jdbcTemplate) {
        $this -> jdbcTemplate = $jdbcTemplate;
    }

    public function getAll() {
        $tableDatas = $this -> jdbcTemplate -> selectColumn($this -> tableName, $this->allColumns);
        $c = new Collection();
        foreach ($tableDatas as $data) {
            $c->addItem(new PresentModel($data),$data['id']);
        }
        return $c;
    }
    
    public function getAllFreePresents() {
        $tableDatas = $this -> jdbcTemplate -> selectColumnConditions($this -> tableName, $this->allColumns, array(self::COLUMN_STATUS => self::PRESENT_STATUS_NOTUSE));
        $c = new Collection();
        foreach ($tableDatas as $data) {
            $c->addItem(new PresentModel($data),$data['id']);
        }
        return $c;
    }
    
    public function existCode($code) {
        return $this -> jdbcTemplate -> isTrue($this->tableName, array(self::COLUMN_CODE => "$code"));
    }
    
    public function getById($presentId) {
        $returnValue = null;    
        $data = $this -> jdbcTemplate ->getByUnique($this->tableName, $this->allColumns, array(self::COLUMN_ID => $presentId));
        if(!empty($data)) {
           $returnValue = new PresentModel($data);
        }
        return $returnValue;
    }
    
    public function update(PresentModel $present) {
        $returnValue = null;        
        $data = $this -> jdbcTemplate ->update($this->tableName, array(self::COLUMN_EDIT_DATE => date("Y-m-d H:i:s"),self::COLUMN_DESCRIPTION => $present->getDescription(), self::COLUMN_IMAGEPATH => $present->getImagePath(), self::COLUMN_TITLE=>$present->getTitle(),self::COLUMN_LINKS=>$present->getLinks()), array(self::COLUMN_ID => $present->getId()));
        if($data == 1){
            $returnValue = $present->getId();
        }
        return $returnValue;
    }
    
    public function delete($presentId) {
        $returnValue = null;        
        $data = $this -> jdbcTemplate ->delete($this->tableName, array(self::COLUMN_ID => $presentId));
        if($data == 1){
            $returnValue = $presentId;
        }
        return $returnValue;
    }
    
    public function getByCode($code) {
        $returnValue = null;    
        $data = $this -> jdbcTemplate ->getByUnique($this->tableName, $this->allColumns, array("AND" => array(self::COLUMN_CODE => $code, self::COLUMN_STATUS => self::PRESENT_STATUS_USE)));
        if(!empty($data)) {
           $returnValue = new PresentModel($data);
        }
        return $returnValue;
    }
    
    public function usePresent($presentId, $code) {
        $status = self::PRESENT_STATUS_USE;
        $rows = $this -> jdbcTemplate ->update($this->tableName, array(self::COLUMN_CODE=>$code,self::COLUMN_STATUS => $status), array(self::COLUMN_ID => $presentId));
        if($rows != 1) {
            return false;
        } else {
            return true;
        }
    }
    
    public function releasePresent($presentId) {
        $status = self::PRESENT_STATUS_NOTUSE;
        $rows = $this -> jdbcTemplate ->update($this->tableName, array(self::COLUMN_EDIT_DATE => date("Y-m-d H:i:s"),self::COLUMN_CODE=>null,self::COLUMN_STATUS => $status), array(self::COLUMN_ID => $presentId));
        if($rows != 1) {
            return false;
        } else {
            return true;
        }
    }
    
    public function createPresent(PresentModel $present) {
        $id = $this -> jdbcTemplate ->insert($this->tableName, array(self::COLUMN_EDIT_DATE => date("Y-m-d H:i:s"),self::COLUMN_DESCRIPTION => $present->getDescription(), self::COLUMN_IMAGEPATH => $present->getImagePath(), self::COLUMN_TITLE=>$present->getTitle(),self::COLUMN_LINKS=>$present->getLinks(),self::COLUMN_STATUS=>PRESENT_STATUS_NOTUSE));
        return $id;
    }
    

}
?>
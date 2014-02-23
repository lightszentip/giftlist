<?php

class DatabaseConnectionModel {

    private $dbName;
    private $server;
    private $user;
    private $password;
    private $drype;
    private $port;

    function __construct($databaseName, $databaseServer, $databaseUser, $databasePassword, $databaseType, $databasePort) {
        $this->dbName = $databaseName;
        $this->password = $databasePassword;
        $this->server = $databaseServer;
        $this->type = $databaseType;
        $this->user = $databaseUser;
        $this->port = $databasePort;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getType() {
        return $this->type;
    }

    public function getDatabaseName() {
        return $this->dbName;
    }

    public function getServer() {
        return $this->server;
    }

    public function getPort() {
        return $this->port;
    }

}

?>
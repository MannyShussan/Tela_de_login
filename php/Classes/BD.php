<?php
class BD
{
    protected $serverName, $userName, $password, $dbName;
    public function __construct()
    {
        $this->serverName = 'localhost';
        $this->userName = "root";
        $this->password = "";
        $this->dbName = "iot";
    }
}

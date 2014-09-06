<?php

namespace SaveUp\Adapters;

class MysqlAdapter
{
    private $db;

    private $username;

    private $password;

    private $host;

    private $port;

    private $connection;

    function __construct($db, $username, $password, $host, $port)
    {
        $this->db = $db; 
        $this->username = $username; 
        $this->password = $password; 
        $this->host = $host; 
        $this->port = $port; 
    }

    public function connect()
    {
        $this->connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);  
    }

    public function is_connected()
    {
        return !! $this->connection; 
    }
}

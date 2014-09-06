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

    public function close()
    {
        if ($this->isConnected())
            mysqli_close($this->connection);
    }

    public function isConnected()
    {
        return !! $this->connection; 
    }

    public function dump()
    {
        return shell_exec("mysqldump -u $this->username -p$this->password $this->db");
    }

    public function hasTable($table)
    {
        return in_array($table, $this->tables());
    }

    public function dropDatabaseTables()
    {
        foreach($this->tables() as $table)
        {
            $this->dropTable($table); 
        }
    }

    public function restoreFromFile($dumpFile)
    {
        shell_exec("mysql -u $this->username -p$this->password $this->db < $dumpFile");
    }

    private function tables()
    {
        $res = mysqli_query($this->connection, "SHOW TABLES");
        $tables = [];

        while($row = $res->fetch_array())
        {
            $tables[] = $row[0];
        }

        return $tables;
    }

    private function dropTable($table)
    {
        mysqli_query($this->connection, "DROP TABLE $table");
    }
}

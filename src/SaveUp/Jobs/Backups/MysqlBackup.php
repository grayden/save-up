<?php

namespace SaveUp\Jobs\Backups;

use SaveUp\Jobs\Job;
use SaveUp\Adapters\MysqlAdapter;
use SaveUp\Adapters\S3Adapter;

class MysqlBackup extends Job
{
    private $mysqlAdapter;

    private $s3Adapter;

    function __construct($db, $username, $password, $host = "localhost", $port = 3306)
    {
        $this->mysqlAdapter = new MysqlAdapter(
            $db,
            $username,
            $password,
            $host,
            $port    
        );

        $this->s3Adapter = new S3Adapter;
    }

    public function backup()
    {
        $this->connect();

    }

    private function load()
    {

    }

    private function connect()
    {
        $this->mysqlAdapter->connect();
    }
}

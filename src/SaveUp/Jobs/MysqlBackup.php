<?php namespace SaveUp\Jobs;

use SaveUp\Jobs\Job;
use SaveUp\Adapters\MysqlAdapter;
use SaveUp\Adapters\S3Adapter;
use SaveUp\Namers\MysqlNamer;

class MysqlBackup extends Job
{
    private $database;

    private $s3Adapter;

    private $backupContents;

    function __construct($baseName, $bucket, $db, $username, $password, $host = "localhost", $port = 3306)
    {
        $this->database = new MysqlAdapter(
            $db,
            $username,
            $password,
            $host,
            $port
        );

        $this->s3Adapter = new S3Adapter($bucket);

        $this->namer = new MysqlNamer($baseName);
    }

    public function backup()
    {
        $this->connect();
        $this->load();
        $this->send();
    }

    private function connect()
    {
        $this->database->connect();
    }

    private function load()
    {
        $this->backupContents = $this->database->dump();
    }

    private function send()
    {
        $this->s3Adapter->save($this->namer->name(), $this->backupContents);
    }
}

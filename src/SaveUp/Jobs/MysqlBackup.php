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

    function __construct(NamerInterface $namer, S3Adapter $s3, MysqlAdapter $mysql)
    {
        $this->database = $mysql;
        $this->s3Adapter = $s3;
        $this->namer = $namer;
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

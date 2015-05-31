<?php

namespace SaveUp\Jobs;

use SaveUp\Adapters\S3Adapter;
use SaveUp\Adapters\MysqlAdapter;
use SaveUp\Adapters\FileAdapter;
use SaveUp\Namers\MysqlNamer;
use SaveUp\Namers\FileNamer;
use SaveUp\Jobs\Job;

class Builder 
{
    private $type;

    private $params;

    public function __construct($type, $params) {
        $this->type = $type;
        $this->params = $params;
    }

    public function job() {
        return new Job(
            $this->namer(),
            $this->sourceAdapter(),
            $this->storageAdapter()
        );
    }

    public function storageAdapter() {
        return new S3Adapter($this->params["bucket"]);
    }

    public function namer() {
        switch($this->type) {
            case "file":
                return new FileNamer($this->params["name_as"]);
            case "database":
                return new MysqlNamer($this->params["name_as"]);
        }
    }

    public function sourceAdapter() {
        switch($this->type) {
            case "file":
                return new FileAdapter($this->params["path"]);
            case "database":
                return new MysqlAdapter($this->params["database"], $this->params["username"], $this->params["password"]);
        }
    }
}

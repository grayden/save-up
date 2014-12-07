<?php

namespace SaveUp\Jobs;

use SaveUp\Namers\NamerInterface;
use SaveUp\Adapters\SourceAdapter;
use SaveUp\Adapters\S3Adapter;

class Job
{
    private $namer;

    private $source;

    private $s3;

    public function __construct(NamerInterface $namer, SourceAdapter $source, S3Adapter $s3)
    {
        $this->namer = $namer;
        $this->source = $source;
        $this->s3 = $s3;
    }

    public function backup() 
    {
        $location = $this->source->toBackup();
        $this->s3->save($this->namer->name(), $location);
        $this->source->clean();
    }
}

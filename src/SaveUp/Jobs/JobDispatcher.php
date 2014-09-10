<?php

namespace SaveUp\Jobs;

class JobDispatcher
{
    private $config;

    public function __construct($configFileName)
    {
        $this->jobsConfig = json_decode(file_get_contents($configFileName), true); 
    }

    public function runJobs()
    {
        foreach($this->jobs() as $job)
        {
            $job->backup();
        }
    }

    private function jobs()
    {
    }
}

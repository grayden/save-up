<?php

namespace SaveUp\Jobs;

abstract class Job
{
    abstract public function backup();
}

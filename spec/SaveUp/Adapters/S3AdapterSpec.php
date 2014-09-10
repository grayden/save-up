<?php

namespace spec\SaveUp\Adapters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class S3AdapterSpec extends ObjectBehavior
{
    function let()
    {
        $_CONFIG = require 'save-up.test.config.php';
        $this->beConstructedWith($_CONFIG['s3']['bucket']);
        $this->shouldHaveType('SaveUp\Adapters\S3Adapter');
    }
}

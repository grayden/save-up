<?php

namespace spec\SaveUp\Adapters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class S3AdapterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SaveUp\Adapters\S3Adapter');
    }
}

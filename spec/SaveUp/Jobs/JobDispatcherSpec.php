<?php

namespace spec\SaveUp\Jobs;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JobDispatcherSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SaveUp\Jobs\JobDispatcher');
    }
}

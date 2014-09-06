<?php

namespace spec\SaveUp\Adapters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlAdapterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("save_up_test_db", "save_up", "save_up", "localhost", 3306);
        $this->shouldHaveType('SaveUp\Adapters\MysqlAdapter');
    }

    function it_should_be_able_to_connect() 
    {
        $this->connect();

        $this->is_connected()->shouldReturn(true);
    }
}

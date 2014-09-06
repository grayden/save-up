<?php

namespace spec\SaveUp\Backups;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlBackupSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SaveUp\Backups\MysqlBackup');
    }

    function it_can_dump_a_database()
    {
    }
}

<?php

namespace spec\SaveUp\Jobs\Backups;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlBackupSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("save_up_test_db", "save_up", "save_up");
        $this->shouldHaveType('SaveUp\Jobs\Backups\MysqlBackup');
    }

    function it_should_be_able_to_backup_a_database()
    {
        $this->backup();
    }
}

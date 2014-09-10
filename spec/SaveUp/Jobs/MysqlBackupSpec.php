<?php

namespace spec\SaveUp\Backups;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MysqlBackupSpec extends ObjectBehavior
{
    function let()
    {
        $_CONFIG = require 'save-up.test.config.php';

        $this->beConstructedWith(
            $_CONFIG['s3']['bucket'],
            $_CONFIG['resposiblities'][0]['database'],
            $_CONFIG['resposiblities'][0]['username'],
            $_CONFIG['resposiblities'][0]['password']
        );

        $this->shouldHaveType('SaveUp\Jobs\Backups\MysqlBackup');
    }

    function it_should_be_able_to_backup_a_database()
    {
        $this->backup();
    }
}

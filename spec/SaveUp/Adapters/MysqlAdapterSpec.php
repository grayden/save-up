<?php

namespace spec\SaveUp\Adapters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class MysqlAdapterSpec extends ObjectBehavior
{
    function let()
    {
        $_CONFIG = require 'save-up.test.config.php';
        $this->beConstructedWith(
            $_CONFIG['responsibilities'][0]['database'],
            $_CONFIG['responsibilities'][0]['username'],
            $_CONFIG['responsibilities'][0]['password'],
            $_CONFIG['responsibilities'][0]['host'],
            $_CONFIG['responsibilities'][0]['port']
        );
        $this->shouldHaveType('SaveUp\Adapters\MysqlAdapter');
    }


    function it_should_be_able_to_connect() 
    {
        $this->connect();
        $this->shouldBeConnected();
        $this->close();
    }

    function it_should_be_able_to_dump_the_database()
    {
        $this->dump()->shouldStartWith("-- MySQL dump");
    }

    function it_should_be_able_to_restore_a_database()
    {
        $this->connect();
        $this->dropDatabaseTables();
        $this->restoreFromFile('fixtures/test_db_fixture.sql');
        $this->shouldHaveTable('bears');
        $this->close();
    }

    function it_should_be_able_drop_all_tables_in_the_database()
    {
        $this->connect();
        $this->restoreFromFile('fixtures/test_db_fixture.sql');
        $this->dropDatabaseTables();
        $this->shouldNotHaveTable('bears');
        $this->close();
    }
}

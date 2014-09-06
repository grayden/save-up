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

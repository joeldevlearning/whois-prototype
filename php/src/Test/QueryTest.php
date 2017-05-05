<?php

namespace RestQuery\Test;

use PHPUnit\Framework\TestCase;
use RestQuery\Query;
use RestQuery\Action\Setup\Create;

class QueryTest extends TestCase
{

    public function queryInputProvider()
    {
        $qSelectors = [
            'pr only' => ['pr'    => 'Apple'],
            'pr, se' => ['pr'    => 'Apple', 'se'    => '192.168.1.1'],
            'pr, se, prflag' => ['pr'    => 'Apple', 'se'    => '192.168.1.1', 'prflag' => 'org'],
            'pr, se, prflag, seflag' => ['pr'    => 'Apple', 'se'    => '192.168.1.1', 'prflag' => 'org', 'seflag' => 'org']
        ];
        return $qSelectors;
    }

    public function queryObjectProvider()
    {
        $qSelectors = ['pr' => 'Apple', 'se' => '192.168.1.1'];
        $qParameters = [];
        //create selector objects
        $primary = Create::Selector('primary', $qSelectors);
        $secondary = Create::Selector('secondary', $qSelectors);

        return Create::Query($primary, $secondary, $qParameters);
    }


    /**
     * @dataProvider queryObjectProvider
     */
    public function testCanCreateQueryWithPrimaryOnly($q)
    {
        $this->assertClassHasAttribute('primary', $q);
    }

    public function testCanCreateQueryWithAllAttributes()
    {
        $qSelectors = [ 'pr' => 'Apple', 'se' => '1928.168.1.1'];
        $qParameters = [];
        $primary = Create::Selector('primary', $qSelectors);
        $secondary = Create::Selector('secondary', $qSelectors);

        $q = Create::Query($primary,$secondary,$qParameters);

        $this->assertClassHasAttribute('primary', \RestQuery\Query::class);
        $this->assertClassHasAttribute('secondary', \RestQuery\Query::class);
        $this->assertClassHasAttribute('qSelectors', \RestQuery\Query::class);

        return $q;
    }

    /**
     * @dataProvider queryObjectProvider
     */
    public function canReturnPrimarySelector()
    {
        $this->assertEquals('Apple', $q->getPrimary());
    }


    public function canReturnSecondarySelector()
    {

    }

    public function canReturnParameters()
    {

    }

    public function canSetPrimarySelector()
    {

    }

    public function canSetSecondarySelector()
    {

    }
}
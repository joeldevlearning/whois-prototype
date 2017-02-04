<?php

/*
 * Defines how Queryable objects can be read
 * Queryables are created by QueryableFactory
 *
 */

namespace RestQuery;


interface IQueryable
{
public function getResult() : \Generator;//generator that returns iterable object of json elements

public function getExpression() : array; //returns an array (record=>$record,field=>$field,string=>$string)

public function getType() : string; //returns "name" or "number" type

public function getFormat() : string; //returns name of whois-rws syntax, maps to Formatter (e.g. url matrix)

}
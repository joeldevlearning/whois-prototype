<?php

/*
 * Defines contract for reading from Queryable objects
 * Queryables are created by QueryableFactory
 *
 */



interface IQueryable
{
public function getResult() : \Generator;//generator that returns iterable object of json elements

public function getExpression() : array; //returns an array (record=>$record,field=>$field,string=>$string)

public function getType() : string; //returns "name" or "number" type

public function getFormat() : string; //returns name of whois-rws uri syntax, maps to Formatter (e.g. url matrix)

}
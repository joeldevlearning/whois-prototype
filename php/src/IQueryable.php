<?php
namespace RestQuery;
/*
 * Defines contract for individual requests to arin-rws and responses
 *
 * Queryables are created by QueryableFactory
 *
 */


interface IQueryable
{
    public function getResult(): \Generator;//generator that returns results array

    public function getExpression(): array; //returns an array (record=>$record,field=>$field,string=>$string)

    public function getType(): string; //returns type of string, e.g. name/ip/postal-code, etc.

    public function getFormat(): string; //returns name of whois-rws uri syntax, maps to Formatter (e.g. url matrix)

    public function serialize(): string; //produce a query string
}
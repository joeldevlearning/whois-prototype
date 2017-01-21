<?php
namespace RestQuery\Action;
use RestQuery\Query;

/*

*/

class Build {

    public static function CreateUri(Query $query){
        foreach($query->qBuildQueue as $queueItem){
        //drill down one level to reach record=>field pairs    
            foreach($queueItem as $record=>$field){
                
                $query->qRunQueue[] = 
                    //$query->qUriFragments['base-uri'] . 
                    $record . 
                    $query->qUriFragments['matrix-record-suffix'] . 
                    $field . 
                    $query->qUriFragments['matrix-field-prefix'] .
                    $query->qElements['pr'];    
            }

        }

    }

//  Scan through outer loop


/*
    What do we know?
        We have a todo list in SOURCE of api calls to make 
        We also have a query string

    What do we need to do?
    First, build the api calls
    That means combine the base URI, the record type, the field type, and user's input string
    Do this for each item in our todo list
    Second, put the each api call in a queue
    
    What is really first though?
    First we have to identify what syntax to use for each api call in our todo list

    Why is that?
    There are three syntaxes - single URI, double URI, and matix URI
    for Q1 we do not need double URI
    so we have to choose between single URI and matrix URI 
    
    What is the bottom line?
    We should try matrix URI any time we can, because it lets us explicitly set the field

    So how do we use the matrix URI syntax in a practical way?
    We should pull a predefined matrix URI string 
    To this we can add
*/

}
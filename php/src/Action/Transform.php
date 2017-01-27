<?php
namespace RestQuery\Action;
use RestQuery\Query;

class Transform {

    public static function Combine(){
        
    }
}

//can remove arin header stuff
/*
 * Our own header could include:
 *      - timestamp
 *      - ARIN api version
 *      - list of original queries made to ARIN AND response code for each one
 * */
//a third of payload is just REST URL links after $, maybe delete these?

//if an entity of the same record type has the SAME name, e.g. org APPLE INC, put them into their own branch?

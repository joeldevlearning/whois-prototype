<?php
namespace RestQuery\Model;

//holds strings for ARIN's REST API syntax

class ArinConfig {

    public static $rwsRootUri = 'http://whois.arin.net/rest/';

    public static $matrixUri = array(
        'matrix-record-suffix'  => "s;",
        'matrix-field-prefix'   => "="
    );
}
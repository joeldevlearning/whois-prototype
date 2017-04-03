<?php

/*
 * Defines contract for all actions, using a yet-to-be-done QueryInterface
 * Right now each action is a mess and they just write to the Query data structures
 *
 * INSTEAD ActionInterface should send data via QueryInterface
 *
 * e.g. consider a function like writeToQuery($data, $query, $caller) in ActionInterface
 * this function can internally use the QueryInterface
 * it can decide what to do based on which action is calling it
 *
 * this separates actions from query; actions know only their interface, which knows QueryInterface
 * and query itself implements its interface
 *
 */

namespace RestQuery\Action;


interface ActionInterface
{

}
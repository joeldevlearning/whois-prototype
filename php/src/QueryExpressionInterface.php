<?php

namespace RestQuery;

interface QueryExpressionInterface
{
    /*
     * generator to direct action sequences
     * follows workflow and returns next action/state to move to
     * auto-increments when called
     *
     * One of four possible workflows:
     * 0 = compose, fulfill, transform, return
     * 1 = compose, fulfill, scrap, transform, return
     * 2 = compose, fulfill, scrap, compose, fulfill, transform, return
     * 3 = compose, fulfill, scrap, compose, fulfill, scrap, transform, return
     */
    public function nextStep() : string;

    /*
     * returns array detailing what record:field combinations to target
     * used by Compose to create Queryables
     * used by Scrap to pull data from Target results
     * used by Transform to prioritize result list
     * created by Analyze action
     */
    public function getTarget() : array;
}
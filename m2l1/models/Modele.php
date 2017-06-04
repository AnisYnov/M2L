<?php

/**
 * Created by PhpStorm.
 * User: blackmister
 * Date: 29/05/2017
 * Time: 01:22
 */
class Model
{
    private $test = "test";

    /**
     * @return string
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * @param string $test
     */
    public function setTest($test)
    {
        $this->test = $test;
    }
}

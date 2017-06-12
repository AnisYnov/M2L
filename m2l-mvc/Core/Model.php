<?php


namespace Core;


class Model
{
    protected static $pdo = null;


    /**
     * Model constructor.
     */
    public function __construct()
    {
        self::$pdo = Database::connect();
    }


}
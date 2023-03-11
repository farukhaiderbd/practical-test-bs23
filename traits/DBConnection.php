<?php
require '../classes/DB.php';

trait DBConnection
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }
}

<?php
namespace Project\Models;
use Exception;
use mysqli;

abstract class DataConnector
{

    public function __construct($dbConnection)
    {
        if ($dbConnection instanceof mysqli) {
            $this->db = $dbConnection;
        } else {
            throw new Exception('Connection injected should be of Mysqli object');
        }
    }
    public function getTotalCustomers(){}
    public function getTotalOrders(){}
    public function getTotalRevenue(){}
}
<?php

namespace Project;

use Project\Controllers\DashboardController;
use Project\Models\DBManager;
use Project\Models\Customer;
use Project\Models\Orders;
use Project\Models\Revenue;

require_once 'bootstrap.php';
require_once 'controllers/ControllerInterface.php';
require_once 'controllers/DashboardController.php';

//setting up database
$db = new DBManager();

//getting in customers
$customers = new Customer($db->connectDB());
$totalCustomers = $customers->getTotalCustomers();

//getting in orders
$orders = new Orders($db->connectDB());
$totalOrders = $orders->getTotalOrders();

//getting revenue
$revenue = new Revenue($db->connectDB());
$totalRevenue = $revenue->getTotalRevenue();

$totalOrdersMonthly = $orders->getMonthlyOrders();

$data = [
    'totalCustomers' => $totalCustomers['total_customers'],
    'totalOrders' => $totalOrders['total_orders'],
    'totalOrdersMonthly' => $totalOrdersMonthly,
    'totalRevenue' => $totalRevenue
];

//Incase routes are required to setup
$requestURI = $_SERVER["REQUEST_URI"];

$view = new DashboardController();
return $view->index($requestURI, $data);

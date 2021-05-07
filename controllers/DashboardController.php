<?php

namespace Project\Controllers;

require 'helpers/Helpers.php';

use ControllerInterface;
use Project\Helpers\Helpers;

class DashboardController implements ControllerInterface
{
    public function __construct()
    {
    }

    public function index($request, $data)
    {
        return $this->renderView($data);
    }

    public function renderView($data)
    {
        $blade = new Helpers();
        echo $blade->loadBladeLibrary()->run(
            'index',
            (array)$data
        );
    }
}

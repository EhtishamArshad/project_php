<?php

spl_autoload_register(function ($class) {
    $parts = explode('\\', $class);
    require 'models/'. end($parts) . '.php';
});
<?php

namespace Mail\Core;

class View
{
    public static function index(string $path, array $variables = [] )
    {
        extract($variables);

        require 'app/View/' . $path;
    }
}
<?php


namespace Mail\Core;


class Register
{
    public static function register(string $path, array $variables = [])
    {

        extract($variables);

        require 'app/View/' . $path;
    }
}
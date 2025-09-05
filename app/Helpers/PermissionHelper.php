<?php

namespace App\Helpers;

class PermissionHelper
{
    public static function apply($controller, $resource)
    {
        $map = config("permission.$resource", []);
        
        foreach ($map as $action => $methods) {
           
            $controller->middleware("can-access:$resource,$action")->only($methods);
        }
    }
}

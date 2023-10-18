<?php


function route_request(){
    $route = $_SERVER['REQUEST_URI'];

    if ($route === "/tutu"){

        require_once('./config/controller.php');
        display_tasks();

        return;
    }

    if ($route === "/form"){

        require_once('./display/control.php');
        display_tasks();

        return;
    }
    echo "<h1>OKEYYY</h1>";

}
route_request();
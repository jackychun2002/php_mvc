<?php
    include_once "databaseP.php";
    include_once "controllers/ControllerP.php";
    $route = isset($_GET["route"])?$_GET["route"]:"";
    $controller = new ControllerP();

    switch ($route){
        case "listproduct": $controller->listProduct(); break;
        case "saveproduct": $controller->saveProduct(); break;
        case "editproduct": $controller->editProduct(); break;
        case "deleteproduct": $controller->deleteProduct(); break;
        case "listcart": $controller->listCart(); break;
        case "addcart": $controller->addCart(); break;
        case "createorder": $controller->createOrder(); break;
        default:$controller->home();
    }
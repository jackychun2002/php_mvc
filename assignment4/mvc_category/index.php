<?php
    include_once "databaseC.php";
    include_once "controllers/ControllerC.php";
    $route = isset($_GET["route"])?$_GET["route"]:"";
    $controller = new ControllerC();

    switch ($route){
        case "savecategory": $controller->saveCategory(); break;
        case "updatecategory": $controller->updateCategory(); break;
        case "deletecategory": $controller->deleteCategory(); break;
        default: $controller->listCategory();
    }
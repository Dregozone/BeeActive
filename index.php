<?php 

    session_start();
    ob_start();

    require 'vendor/autoload.php';

    $config = json_decode( file_get_contents('config/app.json'), true );

    $page = $_GET["p"] ?? $config["default"];
    $page = ucfirst($page);

    require "app/Model/$page.php";
    require "app/Controller/$page.php";
    require "app/View/Base.php";
    require "app/View/$page.php";

    $modelPath = "app\\Model\\$page";
    $controllerPath = "app\\Controller\\$page";
    $viewPath = "app\\View\\$page";

    $model = new $modelPath($page);
    $controller = new $controllerPath($model);
    $view = new $viewPath($model, $controller);

    $action = $_GET["action"] ?? false;

    if ($action && method_exists($controller, $action)) {
        $controller->$action();
    }
    echo $view->render();

    ob_end_flush();

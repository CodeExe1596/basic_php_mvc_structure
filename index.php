<?php 

    /**
     * Define default Root
     */
    define('ROOT', str_replace('index.php','',$_SERVER['SCRIPT_FILENAME']));

    /**
     * Define default Web Root
     */
    define('WEB_ROOT', str_replace('index.php','', $_SERVER['SCRIPT_NAME']));

    /**
     * Include core entities
     */
    require_once(ROOT . 'core/router.php');
    require_once(ROOT . 'core/model.php'); 
    require_once(ROOT . 'core/controller.php');

    /**
     * Redirect to a page from url 
     */
    Router::routeRequest();
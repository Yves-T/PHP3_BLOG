<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$dbInfo = "mysql:host=localhost;dbname=simple_blog";
$dbUser = 'homestead';
$dbPassword = 'secret';

include_once "util/db.config.php";

// model
include_once 'models/Page_Data.class.php';
$pageData = new Page_Data();
$pageData->title = "PHP/MySQL Blog Demo";
$pageData->addCSS('css/blog.css');
$pageData->addScript('js/editor.js');
$pageData->addScript('js/tinymce/tinymce.min.js');
$pageData->content = "<h1>$pageData->title</h1>";

// view
include_once "models/Admin_User.class.php";
$admin = new Admin_User();

$pageData->content = include_once "controllers/admin/login.php";

if ($admin->isLoggedIn()) {
    $pageData->content .= include "views/admin/adminNavigation.php";
    $navigationIsClicked = isset($_GET['page']);
    if ($navigationIsClicked) {
        $controller = $_GET['page'];
    } else {
        $controller = "entries";
    }
    $pathToController = "controllers/admin/$controller.php";
    $pageData->content .= include_once $pathToController;
}

$page = include_once 'views/page.php';

// model and view
echo $page;

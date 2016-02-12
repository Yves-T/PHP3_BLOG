<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "util/db.config.php";

// model
include_once 'models/Page_Data.class.php';
$pageData = new Page_Data();
$pageData->title = "PHP/MySQL Blog Demo";
$pageData->addCSS('css/blog.css');
$pageData->content = "<h1>$pageData->title</h1>";
//$pageData->content .= "<h1>All is good</h1>";
$pageData->content .= include_once "views/search_form_html.php";

$controller = (isset($_GET['page']) && $_GET['page'] === 'search') ? 'search' : 'blog';

$pageData->content .= include_once "controllers/$controller.php";

// view
$page = include_once "views/page.php";


// view and model
echo $page;

<?php
$loginFormSubmitted = isset($_POST['log-in']);
if ($loginFormSubmitted) {
    echo "user is loggin in";
    $admin->login();
}

$loggingOut = isset ($_POST['logout']);
if ($loggingOut) {
    $admin->logout();
}
if ($admin->isLoggedIn()) {
    $view = include_once "views/admin/logout_form_html.php";
} else {
    $view = include_once "views/admin/login_form_html.php";
}

return $view;

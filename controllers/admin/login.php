<?php
$loginFormSubmitted = isset($_POST['log-in']);
if ($loginFormSubmitted) {
    echo "user is loggin in";
    $admin->login();
}
$view = include_once "views/admin/login_form_html.php";
return $view;

<?php
include_once "models/Admin_Table.class.php";
$loginFormSubmitted = isset($_POST['log-in']);
if ($loginFormSubmitted) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //create an object for communicating with the database table
    $adminTable = new Admin_Table($db);
    try {
        $adminTable->checkCredentials($email, $password);
        $admin->login();
    } catch (Exception $e) {
        // NOP
    }
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

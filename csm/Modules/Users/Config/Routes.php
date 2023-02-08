<?php
  
$routes->group("users", ["namespace" => "\Modules\Users\Controllers"], function ($routes) {

    // GET
	$routes->get("/", "UsersController::index");
    $routes->get("users-datatable", "UsersController::ajaxDataTables");
    $routes->get("check_email", "UsersController::check_email");
    $routes->get("check_username", "UsersController::check_username");
    $routes->get("get_user", "UsersController::get_user");

    // POST
    $routes->post("save_user", "UsersController::save_user");
    
});

?>
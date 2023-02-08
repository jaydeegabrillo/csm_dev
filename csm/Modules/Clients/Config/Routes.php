<?php
  
$routes->group("clients", ["namespace" => "\Modules\Clients\Controllers"], function ($routes) {

    // GET
	$routes->get("/", "ClientsController::index");
    $routes->get("clients-datatable", "ClientsController::ajaxDataTables");
    $routes->get("get_client", "ClientsController::get_client");
    $routes->get("check_email", "ClientsController::check_email");
    
    // POST
    $routes->post("save_client", "ClientsController::save_client");
    
});

?>
<?php
  
$routes->group("assignments", ["namespace" => "\Modules\Assignments\Controllers"], function ($routes) {

    // GET
	$routes->get("/", "AssignmentsController::index");
    $routes->get("assignments-datatable", "AssignmentsController::ajaxDataTables");
    $routes->get("get_assignment", "AssignmentsController::get_assignment");
    $routes->get("get_staff", "AssignmentsController::get_staff");
   
    // POST
    $routes->post("save_assignment", "AssignmentsController::save_assignment");
});

?>
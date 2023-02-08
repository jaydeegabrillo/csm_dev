<?php

$routes->group("dashboard", ["namespace" => "Modules\Dashboard\Controllers"], function ($routes) {

	$routes->get("/", "DashboardController::index");
	$routes->get("clock_in/(:num)", "DashboardController::clock_in/$1");
	$routes->get("clock_out/(:num)", "DashboardController::clock_out/$1");
	$routes->get("delete_log/(:num)", "DashboardController::delete_log/$1");
	$routes->get("dashboard-datatable", "DashboardController::ajaxDatatables");

	$routes->get("edit_log", "DashboardController::edit_log");
});
?>
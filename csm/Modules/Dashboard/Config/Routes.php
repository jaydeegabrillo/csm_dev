<?php

$routes->group("dashboard", ["namespace" => "Modules\Dashboard\Controllers"], function ($routes) {

	$routes->get("/", "DashboardController::index");
	$routes->get("clock_in/(:num)/(:any)", "DashboardController::clock_in/$1/$2");
	$routes->get("clock_out/(:num)/(:any)", "DashboardController::clock_out/$1/$2");
	$routes->get("delete_log/(:num)", "DashboardController::delete_log/$1");
	$routes->get("dashboard-datatable", "DashboardController::ajaxDatatables");

	$routes->get("edit_log", "DashboardController::edit_log");
});
?>

<?php
  
$routes->group("schedules", ["namespace" => "\Modules\Schedules\Controllers"], function ($routes) {

    // GET
	$routes->get("/", "SchedulesController::index");
	$routes->get("getEvents/(:any)", "SchedulesController::getEvents/$1");
	$routes->get("eventCalendar/(:any)", "SchedulesController::eventCalendar/$1");
});

?>
<?php
  
$routes->group("timesheet", ["namespace" => "\Modules\Timesheet\Controllers"], function ($routes) {

	$routes->get("/", "TimesheetController::index");
    $routes->get("timesheet-datatable", "TimesheetController::ajaxDataTables");
    $routes->get("timesheet_pdf", "TimesheetController::timesheet_pdf");

    // post
    // $routes->match(['get'], 'timesheet_pdf', 'TimesheetController::timesheet_pdf');
});

?>
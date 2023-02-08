<?php
  
$routes->group("notes", ["namespace" => "\Modules\Notes\Controllers"], function ($routes) {

    // GET
	$routes->get("/", "NotesController::index");
});

?>
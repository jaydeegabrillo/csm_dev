<?php

namespace Modules\Notes\Controllers;

use App\Controllers\BaseController;
use Modules\Notes\Models\NotesModel;
use \Hermawan\DataTables\DataTable;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class NotesController extends BaseController
{
    protected $db;
    private $assignments_model;
    protected $session;

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->assignments_model = new \Modules\Assignments\Models\AssignmentsModel;
    }

    public function index()
    {
        $data['title'] = 'Notes';
        $script['js_scripts'] = array();
        $script['css_scripts'] = array();
        $pages['index'] = '\Modules\Notes\Views\index';
        
        $this->page_templates($pages,$data,$script);
    }

    public function ajaxDataTables(){
        $builder = $this->assignments_model->assignments();

        return DataTable::of($builder)
        ->edit('inclusive_dates', function($row){
          $date = explode(' ',$row->inclusive_dates);
          $date_start = date('F d, Y', strtotime($date[0]));
          $date_end = date('F d, Y', strtotime($date[1]));
          return $date_start . ' - ' . $date_end;
        })
        ->edit('time', function($row){
          $time = explode('-',$row->time);
          $time_start = date('h:i A', strtotime($time[0]));
          $time_end = date('h:i A', strtotime($time[1]));
          return $time_start . ' - ' . $time_end;
        })
        ->add('action',function($row){
            return '<button type="button" class="btn btn-warning btn-sm view_assignment" data-toggle="modal" data-target="#add_assignment_modal" data-id="'.$row->id.'"><i class="fa fa-eye"></i>View</button>
                    <button type="button" class="btn btn-primary btn-sm edit_assignment" data-toggle="modal" data-target="#add_assignment_modal" data-id="'.$row->id.'"><i class="fa fa-edit"></i>Edit</button>';
        }, 'last')
        ->toJson();
    }
}

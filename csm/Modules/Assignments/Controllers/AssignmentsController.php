<?php

namespace Modules\Assignments\Controllers;

use App\Controllers\BaseController;
use Modules\Assignments\Models\AssignmentsModel;
use \Hermawan\DataTables\DataTable;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class AssignmentsController extends BaseController
{
    protected $db;
    private $assignments_model;

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->assignments_model = new \Modules\Assignments\Models\AssignmentsModel;
    }

    public function index()
    {
        $data['title'] = 'Assignments';
        $data['clients'] = $this->assignments_model->get_clients();
        $data['staves'] = $this->assignments_model->get_staves();
        $data['positions'] = $this->assignments_model->get_positions();
        $pages['index'] = '\Modules\Assignments\Views\index';
        $pages['modal'] = '\Modules\Assignments\Views\modals';
        $script['js_scripts'] = array();
        $script['css_scripts'] = array();
        array_push($script['js_scripts'],'/assignments/assignments.js');
        array_push($script['css_scripts'],'/assignments/assignments.css');

        $this->page_templates($pages,$data,$script);
    }

    public function save_assignment(){
        if($this->request->getMethod() == 'post'){
            $id = $this->request->getVar('id');

            foreach ($this->request->getVar() as $key => $value) {
                $data[$key] = $value;
            }
          
          	unset($data['/assignments/save_assignment']);

            if(isset($id) && $id != NULL){
                $result = $this->db->table('assignments')->where('id', $id)->update($data);
                if($result){
                    $alert = array(
                        'header' => 'Success!',
                        'message' => 'Assignment data has been updated!',
                        'type' => 'success'
                    );
                }else{
                    $alert = array(
                        'header' => 'Oops!',
                        'message' => 'Something went wrong...',
                        'type' => 'error'
                    );
                }
                echo json_encode($alert);
            }else{
                unset($data['id']);
                $result = $this->db->table('assignments')->insert($data);

                if($result){
                    $alert = array(
                        'header' => 'Success!',
                        'message' => 'Assignment data has been added!',
                        'type' => 'success'
                    );
                }else{
                    $alert = array(
                        'header' => 'Oops!',
                        'message' => 'Something went wrong...',
                        'type' => 'error'
                    );
                }
                echo json_encode($alert);
            }
        }
    }

    public function get_assignment(){
        $id = $this->request->getVar('id');
        
        if($id){
            $result = $this->assignments_model->get_assignment($id);
            
            echo ($result) ? json_encode($result[0]) : 0;
        }
    }

    public function get_staff(){
        $data = array();
        $staff = array();
        
        foreach ($this->request->getVar() as $key => $value) {
            $data[$key] = $value;
        }

        if($data['start_date'] != '' || $data['end_date'] != '' || $data['time_start'] != '' || $data['time_end'] != ''){
            $availability = $this->assignments_model->get_availability($data);
          
            foreach ($availability as $ind => $available) {
                array_push($staff, $available);
                if($data['time_start'] >= $available->time_start && $data['time_start'] <= $available->time_end){
                    if($data['start_date'] >= $available->start_date && $data['start_date'] <= $available->end_date){
                        // array_push($staff, )
                        // echo json_encode(array('id' => '', 'name' => 'No Staff Available'));
                    }else{
                        array_push($staff, $available);
                    }
                }else{
                    array_push($staff, $available);
                }
            }
        }
        

        echo json_encode($staff);
    }

    public function ajaxDataTables(){
        $position = $this->session->get('position');
        $id = ($position <= 2) ? 0 : $this->session->get('user_id');
        $builder = $this->assignments_model->assignments($id);

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

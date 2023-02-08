<?php

namespace Modules\Clients\Controllers;

use App\Controllers\BaseController;
use Modules\Clients\Models\UserModel;
use \Hermawan\DataTables\DataTable;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class ClientsController extends BaseController
{
    protected $db;
    private $clients_model;
    protected $session;

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->clients_model = new \Modules\Clients\Models\ClientsModel;
    }
    
    public function index()
    {   
        $data['title'] = 'Clients';
        $script['js_scripts'] = array();
        $script['css_scripts'] = array();
        $pages['index'] = '\Modules\Clients\Views\index';
        $pages['modal'] = '\Modules\Clients\Views\modals';
        array_push($script['js_scripts'],'/clients/clients.js');
        array_push($script['js_scripts'],'/js/inputmask.min.js');
        array_push($script['css_scripts'],'/clients/clients.css');
        $this->page_templates($pages,$data,$script);
    }

    public function ajaxDataTables(){        
        $builder = $this->clients_model->clients();
        
        return DataTable::of($builder)
        ->edit('gender', function($row){
            if($row->gender == 1){
                return "Male";
            }else{
                return "Female";
            }
        })
        ->edit('phone', function($row){
            $first = ($row->phone) ? substr($row->phone, -10, -7) : 'XXX';
            $second = ($row->phone) ? substr($row->phone, -7, -4) : 'XXX';
            $third= ($row->phone) ? substr($row->phone, -4) : 'XXX';

            $output = "(". $first . ") " . $second . "-" . $third; 

            return $output;
        })
        ->edit('marital_status', function($row){
            if($row->marital_status == 1){
                return "Married";
            }else if($row->marital_status == 2){
                return "Widowed";
            }else if($row->marital_status == 3){
                return "Divorced";
            }else if($row->marital_status == 4){
                return "Single";
            }else if($row->marital_status == 5){
                return "Separated";
            }else if($row->marital_status == 6){
                return "Unknown";
            }
        })
        ->edit('ethnicity', function($row){
            if($row->ethnicity == 1){
                return "American Indian or Alaska Native";
            }else if($row->ethnicity == 2){
                return "Asian";
            }else if($row->ethnicity == 3){
                return "Black or African-American";
            }else if($row->ethnicity == 4){
                return "Hispanic or Latino";
            }else if($row->ethnicity == 5){
                return "Native Hawaiian or Pacific Islander";
            }else if($row->ethnicity == 6){
                return "White";
            }else if($row->ethnicity == 7){
                return "Unknown";
            }
        })
        ->add('action',function($row){
            return '<button type="button" class="btn btn-warning btn-sm view_client" data-action="view" data-toggle="modal" data-target="#add_client_modal" data-id="'.$row->id.'"><i class="fa fa-eye"></i>View</button>
                    <button type="button" class="btn btn-primary btn-sm edit_client" data-action="edit" data-toggle="modal" data-target="#add_client_modal" data-id="'.$row->id.'"><i class="fa fa-edit"></i>Edit</button>';
        }, 'last')
        ->toJson();
    }

    public function get_client(){
        $id = $this->request->getVar('id');
        
        if($id){
            $result = $this->clients_model->get_client_data($id);
            
            echo ($result) ? json_encode($result[0]) : 0;
        }
    }

    public function save_client(){
        if($this->request->getMethod() == 'post'){
            $id = $this->request->getVar('id');
            
            foreach ($this->request->getVar() as $key => $value) {
                if($key == 'phone'){
                    $value = preg_replace("/[^0-9]/", "", $value);
                }
                $data[$key] = $value;
            }
          
          	unset($data['/clients/save_client']);
            
            if(isset($id) && $id != NULL){
                $result = $this->db->table('clients')->where('id', $id)->update($data);
                if($result){
                    $alert = array(
                        'header' => 'Success!',
                        'message' => 'Client data has been updated!',
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
                $result = $this->db->table('clients')->insert($data);

                if($result){
                    $alert = array(
                        'header' => 'Success!',
                        'message' => 'Client data has been added!',
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

    public function check_email(){
        $email = $this->request->getVar('email');
        
        if(isset($email) || $email != NULL) {
            $query = $this->db->table('clients')->where('email', $email)->where('deleted', 0)->get();
            
            if($query->getNumRows() > 0){
                echo true;
            }else{
                echo false;
            }

        }else{
            echo false;
        }

    }
}

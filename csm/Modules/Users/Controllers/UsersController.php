<?php

namespace Modules\Users\Controllers;

use App\Controllers\BaseController;
use Modules\Users\Models\UserModel;
use \Hermawan\DataTables\DataTable;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class UsersController extends BaseController
{
    protected $db;
    private $user_model;
    protected $session;

    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db = \Config\Database::connect();
        $this->user_model = new \Modules\Users\Models\UsersModel;
    }
    
    public function index()
    {   
        $data['title'] = 'Users';
        $data['positions'] = $this->user_model->get_positions();
        $pages['index'] = '\Modules\Users\Views\index';
        $pages['modal'] = '\Modules\Users\Views\modals';
        $script['js_scripts'] = array();
        $script['css_scripts'] = array();
        array_push($script['js_scripts'],'/users/users.js');
        array_push($script['css_scripts'],'/users/users.css');
        $this->page_templates($pages,$data,$script);
    }

    public function ajaxDataTables(){        
        $builder = $this->user_model->users();
        
        return DataTable::of($builder)
        ->edit('title', function($row){
            return ucfirst($row->title);
        })
        ->add('action',function($row){
            return '<button type="button" class="btn btn-warning btn-sm view_user" data-toggle="modal" data-target="#add_user_modal" data-id="'.$row->id.'"><i class="fa fa-eye"></i>View</button>
                    <button type="button" class="btn btn-primary btn-sm edit_user" data-toggle="modal" data-target="#add_user_modal" data-id="'.$row->id.'"><i class="fa fa-edit"></i>Edit</button>';
        }, 'last')
        ->toJson();
    }

    public function save_user(){
        $encrypter = \Config\Services::encrypter();

        $cipher = "AES-256-CBC";
        $secret = "mdsolutions";
        $option = 0;

        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
      
        if($this->request->getMethod() == 'post'){
            $id = $this->request->getVar('id');
            
            foreach ($this->request->getVar() as $key => $value) {
                if($key == 'password'){
                    $data[$key] = openssl_encrypt($value, $cipher, $secret, $option, $iv);
                }else{
                    $data[$key] = $value;
                }
            }
          
          unset($data['/users/save_user']);

            // $data['position_id'] = 3;

            if(isset($id) && $id != NULL){
                $result = $this->db->table('users')->where('id', $id)->update($data);
                if($result){
                    $alert = array(
                        'header' => 'Success!',
                        'message' => 'User has been updated!',
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
              
                $result = $this->db->table('users')->insert($data);

                if($result){
                    $alert = array(
                        'header' => 'Success!',
                        'message' => 'User has been added!',
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

    public function get_user(){
        $id = $this->request->getVar('id');
        
        if($id){
            $result = $this->user_model->get_user_data($id);
            
            echo ($result) ? json_encode($result[0]) : 0;
        }
    }

    public function check_email(){
        $email = $this->request->getVar('email');

        if(isset($email) || $email != NULL) {
            $query = $this->db->table('users')->where('email', $email)->where('deleted', 0)->get();

            if($query->getNumRows() > 0){
                echo true;
            }else{
                echo false;
            }

        }else{
            echo false;
        }

    }

    public function check_username(){
        $username = $this->request->getVar('username');

        if(isset($username) || $username != NULL) {
            $query = $this->db->table('users')->where('username', $username)->where('deleted', 0)->get();

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

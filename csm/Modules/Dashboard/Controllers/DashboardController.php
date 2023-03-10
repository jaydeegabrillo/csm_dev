<?php

namespace Modules\Dashboard\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class DashboardController extends BaseController
{
    private $dashboard_model;
    protected $session;

    function __construct(){
        $this->session = \Config\Services::session();
        $this->dashboard_model = new \Modules\Dashboard\Models\DashboardModel;
    }

    public function index()
    {
        $id = ($this->is_logged_in()) ? $this->session->get()['user_id'] : 0 ;
        $data['title'] = 'Dashboard';
        $data['clocked'] = ($this->dashboard_model->check_log($id)) ? 'clock_red' : 'clock_green';
        $data['time_clocked'] = ($this->dashboard_model->check_log($id)) ? $this->dashboard_model->check_log($id)->clock_in : 0;
        $data['active_users'] = $this->dashboard_model->user_count();
        $pages['index'] = '\Modules\Dashboard\Views\index';
        $pages['modal'] = '\Modules\Dashboard\Views\modals';
        $script['css_scripts'] = array();
        $script['js_scripts'] = array();

        array_push($script['css_scripts'],'/dashboard/dashboard.css');
        array_push($script['js_scripts'],'/dashboard/dashboard.js');
        $this->page_templates($pages,$data,$script);
    }

    public function clock_in($assignment_id = 0, $date = ''){
        $user_id = $this->session->get()['user_id'];

        if($assignment_id){
            $check = $this->dashboard_model->log($user_id, $assignment_id, $date);

            if($check){
                echo json_encode(array('type' => 'update'));
            }else{
                echo json_encode(array('type' => 'insert'));
            }
        }else{
            echo json_encode(array('type' => 'error'));
        }
    }

    public function delete_log($id){
        $result = $this->dashboard_model->delete_log($id);

        if($result){
            echo json_encode(array('success' => true));
        }else{
            echo json_encode(array('success' => false));
        }
    }

    public function edit_log(){
        if($this->request->getMethod() == 'get'){
            $id = $this->request->getVar('id');
            $in = $this->request->getVar('in');
            $out = $this->request->getVar('out');
            $date = $this->request->getVar('date');
            $day = ($date == '') ? 'Y-m-d' : date('Y-m-d', strtotime($date));

            if($in != '' && $out != ''){
                $data = array(
                    'clock_in' => date($day.' h:i:s', strtotime($in)),
                    'clock_out' => date($day.' h:i:s',strtotime($out))
                );
            } else {
                if($in == '' && $out != ''){
                    $data = array(
                        'clock_out' => date($day.' h:i:s',strtotime($out))
                    );
                }else{
                    $data = array(
                        'clock_in' => date($day.' h:i:s',strtotime($in))
                    );
                }
            }

            $update = $this->dashboard_model->edit_log($id, $data, $date);

            if($update){
                echo json_encode(array('success' => true));
            }else{
                echo json_encode(array('success' => false));
            }
        }
    }

    public function ajaxDataTables(){
        $position = $this->session->get('position');
        $id = ($position <= 2) ? 0 : $this->session->get('user_id');
        $data = array(
            'search_date' => $this->request->getVar('search_date')
        );

        $builder = $this->dashboard_model->timesheet($id, $data);

        return DataTable::of($builder)
        ->filter(function ($builder, $request){
            if($request->search_date){
                $builder->where('date', $request->search_date);
            }
        })
        ->edit('time',function($row){
            $time = explode("-",$row->time);
            $time_start = date('H:i A', strtotime($time[0]));
            $time_end = date('H:i A', strtotime($time[1]));

            return $time_start . "-" . $time_end;
        })
        ->edit('in', function($row){
            $date = ($row->date != date('Y-m-d')) ? $row->date : date('Y-m-d');
            if($row->in == ''){
                return '<span class="clock_in" data-id="'.$row->id.'" data-date="'.$date.'"><i class="fa fa-clock"></i></span>';
            }else{
                return date('H:i A', strtotime($row->in));
            }
        })
        ->edit('out', function($row){
            $date = ($row->date != date('Y-m-d')) ? $row->date : date('Y-m-d');
            if($row->in == '' && $row->out == ''){
                return '<span class="clock_out" data-id="'.$row->id.'">-</span>';
            }else{
                if($row->out == '' || $row->out == '0000-00-00 00:00:00'){
                    return '<span class="clock_out" data-id="'.$row->id.'" data-date="'.$date.'"><i class="fa fa-clock"></i></span>';
                }else{
                    return date('H:i A', strtotime($row->out));
                }
            }
        })
        ->edit('date', function($row){
            return date('Y-m-d');
        })
        ->add('action',function($row){
            $in = ($row->in == '') ? '' : date("H:i", strtotime($row->in));
            $out = ($row->out == '') ? '' : date("H:i", strtotime($row->out));
            $date = ($row->date == '') ? date('Y-m-d') : $row->date;
            if($this->session->get('position') <= 2){
                return '<button type="button" class="btn btn-primary btn-sm edit_log_modal" data-in="'.$in.'" data-out="'.$out.'" data-date="'.$date.'" data-action="edit" data-toggle="modal" data-target="#edit_log_modal" data-id="'.$row->id.'"><i class="fa fa-edit"></i>Edit</button>
                <button type="button" class="btn btn-danger btn-sm delete_log_modal" data-action="delete" data-toggle="modal" data-target="#delete_log_modal" data-id="'.$row->id.'" data-date="'.$date.'"><i class="fa fa-trash"></i>Delete</button>';
            } else {
                return '';
            }
        }, 'last')
        ->toJson();
    }
}

<?php

namespace Modules\Timesheet\Controllers;

use App\Controllers\BaseController;
use \Hermawan\DataTables\DataTable;
use Dompdf\Dompdf;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class TimesheetController extends BaseController
{
    private $timesheet_model;
    private $_user;
    protected $session;

    function __construct(){
        $this->session = \Config\Services::session();
        $this->timesheet_model = new \Modules\Timesheet\Models\TimesheetModel;
        $this->_user = $this->session->get();
    }

    public function index()
    {
        $id = $this->_user['user_id'];

        $builder = $this->timesheet_model->timesheet($id);
        $data['title'] = 'Timesheet';
        $script['css_scripts'] = array();
        $script['js_scripts'] = array();
        $pages['index'] = '\Modules\Timesheet\Views\index';
        $pages['modal'] = '\Modules\Timesheet\Views\modals';
        array_push($script['css_scripts'],'/timesheet/timesheet.css');
        array_push($script['js_scripts'],'/timesheet/timesheet.js');

        $this->page_templates($pages,$data,$script);
    }

    public function timesheet_pdf(){
        $posted = $this->request->getVar();
        $start_date = $posted['start_date'];
        $end_date = $posted['end_date'];
        $position = $this->session->get('position');
        $id = ($position <= 2) ? 0 : $this->_user['user_id'];
        $timesheet = $this->timesheet_model->timesheet_pdf($id,$posted)->get()->getResult();
        // $data['timesheet'] = $timesheet;
        $ctr = 0;
        $data['timesheet'][$ctr] = array();

        foreach ($timesheet as $key => $value) {
            if($key > 0){
                if($value->name != $timesheet[$key-1]->name){
                    $ctr += 1;
                    $data['timesheet'][$ctr] = array();
                }
            }
            array_push($data['timesheet'][$ctr], $value);
        }

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('\Modules\Timesheet\Views\timesheet_pdf', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("timesheet_report", array("Attachment" => 0));
        exit(0);
    }

    public function ajaxDataTables(){
        $position = $this->session->get('position');
        $id = ($position <= 2) ? 0 : $this->_user['user_id'];
        $builder = $this->timesheet_model->timesheet($id);

        return DataTable::of($builder)
            ->edit('date', function($row){
                $date = ($row->date) ? $row->date : 0;
                return date('F d, Y', strtotime($date));
                }, 'last')
            ->edit('clock_in', function($row){
                $clock_in = ($row->clock_in) ? date("g:i A", strtotime($row->clock_in)) : 'N/A';

                return $clock_in;
                }, 'last')
            ->edit('clock_out', function($row){
                $clock_out = ($row->clock_out) ? date("g:i A", strtotime($row->clock_out)) : 'N/A';

                return $clock_out;
                }, 'last')
            ->add('hours', function($row){
                if($row->clock_out == NULL){
                    return "0 hrs";
                }else{
                    $start = strtotime($row->clock_in);
                    $end = strtotime($row->clock_out);

                    $hours = date('H:i:s', $end-$start);
                    $duration = $end-$start;
                    $hours = (int)($duration/60/60);
                    $minutes = (int)($duration/60)-$hours*60;

                    return $hours." hrs ".$minutes." mins";
                }
                }, 'last')
            ->toJson();
    }
}

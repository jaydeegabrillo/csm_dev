<?php

namespace Modules\Schedules\Controllers;

use App\Controllers\BaseController;
use Modules\Notes\Models\SchedulesModel;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class SchedulesController extends BaseController
{
    private $schedules_model;
    protected $session;

    function __construct() { 
        $this->session = \Config\Services::session();
        $this->schedules_model = new \Modules\Schedules\Models\SchedulesModel;
    } 
     
    public function index(){ 
        $this->eventCalendar();
    } 
     
    /* 
     * Generate calendar with events 
     */ 
    public function eventCalendar($year = '', $month = ''){
        $position = $this->session->get('position');
        $id = ($position <= 2) ? 0 : $this->session->get('user_id'); 
        $data = array(); 
        $script['js_scripts'] = array();
        $script['css_scripts'] = array();
        $script['title'] = 'Schedules';
        $data['title'] = 'Schedules';
        $data['id'] = $id;
        $pages['index'] = '\Modules\Schedules\Views\event-cal';
        array_push($script['js_scripts'],'/schedules/schedules.js');
        array_push($script['css_scripts'],'/schedules/schedules.css');
        $dateYear = ($year != '')?$year:date("Y"); 
        $dateMonth = ($month != '')?$month:date("m"); 
        $date = $dateYear.'-'.$dateMonth.'-01'; 
        $end_date = date("$dateYear-$dateMonth-t");
        $last_day = date('t', strtotime($end_date));
        $eventDate = empty($year) && empty($month)?date("Y-m-d"):$date; 
        $currentMonthFirstDay = date("N", strtotime($date)); 
        $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear); 
        $totalDaysOfMonthDisplay = ($currentMonthFirstDay == 1)?($totalDaysOfMonth):($totalDaysOfMonth + ($currentMonthFirstDay - 1)); 
        $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42; 
         
        $prevMonth = date("m", strtotime('-1 month', strtotime($date))); 
        $prevYear = date("Y", strtotime('-1 month', strtotime($date))); 
        $totalDaysOfMonth_Prev = cal_days_in_month(CAL_GREGORIAN, $prevMonth, $prevYear); 
        if($id != 0){
            $con = array( 
                'where' => array( 
                    'id' => $id,
                    'deleted' => 0 
                ), 
                'where_year' => $dateYear, 
                'where_month' => $dateMonth 
            );
        }else{
            $con = array( 
                'where' => array(
                    'deleted' => 0 
                ), 
                'where_year' => $dateYear, 
                'where_month' => $dateMonth 
            );
        }

        $data['events'] = $this->schedules_model->getGroupCount($con); 
        $data['calendar'] = array( 
            'dateYear' => $dateYear, 
            'dateMonth' => $dateMonth, 
            'date' => $date, 
            'currentMonthFirstDay' => $currentMonthFirstDay, 
            'totalDaysOfMonthDisplay' => $totalDaysOfMonthDisplay, 
            'boxDisplay' => $boxDisplay, 
            'totalDaysOfMonth_Prev' => $totalDaysOfMonth_Prev 
        ); 
         
        $data['monthOptions'] = $this->getMonths($dateMonth); 
        $data['yearOptions'] = $this->getYears($dateYear); 
        $data['eventList'] = $this->getEvents($id, $eventDate, 'return'); 
 
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])){ 
            echo view('\Modules\Schedules\Views\event-cal', $data);
        }else{
            $this->page_templates($pages,$data,$script);
            // echo view('defaults/header',$script);
            // echo view('defaults/sidebar', $data);
            // echo view('\Modules\Schedules\Views\event-cal', $data);
            // echo view('defaults/footer',$script);
        } 
    } 
     
    /* 
     * Generate months options list for select box 
     */ 
    function getMonths($selected = ''){ 
        $options = ''; 
        for($i=1;$i<=12;$i++) 
        { 
            $value = ($i < 10)?'0'.$i:$i; 
            $selectedOpt = ($value == $selected)?'selected':''; 
            $options .= '<option value="'.$value.'" '.$selectedOpt.' >'.date("F", mktime(0, 0, 0, $i+1, 0, 0)).'</option>'; 
        } 
        return $options; 
    } 
    
    /* 
     * Generate years options list for select box 
     */ 
    function getYears($selected = ''){ 
        $yearInit = !empty($selected)?$selected:date("Y"); 
        $yearPrev = ($yearInit - 5); 
        $yearNext = ($yearInit + 5); 
        $options = ''; 
        for($i=$yearPrev;$i<=$yearNext;$i++){ 
            $selectedOpt = ($i == $selected)?'selected':''; 
            $options .= '<option value="'.$i.'" '.$selectedOpt.' >'.$i.'</option>'; 
        } 
        return $options; 
    } 
    
    /* 
     * Generate events list in HTML format 
     */ 
    function getEvents($id = 0, $date = '', $return='view'){ 
        $date = $date?$date:date("Y-m-d");
         
        // Fetch events based on the specific date
        if($id == 0){
            $con = array( 
                'where' => array( 
                    'start_date <=' => $date, 
                    'end_date >=' => $date, 
                    'deleted' => 0
                )
            );
        }else{
            $con = array( 
                'where' => array( 
                    'assigned_user' => $id,
                    'start_date <=' => $date, 
                    'end_date >=' => $date, 
                    'deleted' => 0
                ) 
            ); 
        }
        $events = $this->schedules_model->getRows($con); 
        
        $eventListHTML = '<h2 class="sidebar__heading">'.date("l", strtotime($date)).'<br>'.date("F d, Y", strtotime($date)).'</h2>'; 
        if(!empty($events)){ 
            $eventListHTML .= '<ul class="sidebar__list">'; 
            $eventListHTML .= '<li class="sidebar__list-item sidebar__list-item--complete">Events</li>'; 
            $i = 0; 
            foreach($events as $row){ $i++; 
                $eventListHTML .= '<li class="sidebar__list-item"><span class="list-item__time">'.$i.'.</span>'.$row['reason'].'</li>'; 
            } 
            $eventListHTML .= '</ul>'; 
        } 
         
        if($return == 'return'){ 
            return $eventListHTML; 
        }else{ 
            echo $eventListHTML;     
        } 
    } 
}

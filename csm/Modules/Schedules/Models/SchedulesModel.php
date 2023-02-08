<?php

namespace Modules\Schedules\Models;

use CodeIgniter\Model;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class SchedulesModel extends Model
{
    protected $table;
    function __construct() { 
        // Set table name 
        $this->table = 'events'; 
    } 
     
    /* 
     * Fetch event data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
        $db = \Config\Database::connect();
        $builder = $db->table('assignments a');
        $builder->select('*');
        // $builder = $db->table('daily_logs d');
        // $builder->select('*')->join('assignments a', 'a.id = d.assignment_id')->where('a.start_date >=', $params['where']['d.date'])->where('a.end_date', $params['where']['d.date']);
        
        if(array_key_exists("where", $params)){ 
            foreach($params['where'] as $key => $val){ 
                $builder->where($key, $val); 
            } 
        }

        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $builder->countAllResults(); 
        }else{ 
            if(array_key_exists("id", $params) || (array_key_exists("returnType", $params) && $params['returnType'] == 'single')){ 
                if(!empty($params['id'])){ 
                    $builder->where('id', $params['id']); 
                } 
                $query = $builder->get(); 
                $result = $query->rowArray(); 
            }else{ 
                // $builder->orderBy('date', 'asc'); 
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $builder->limit($params['limit'],$params['start']); 
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $builder->limit($params['limit']); 
                }

                $query = $builder->get();
                $result = ($query->getNumRows() > 0)?$query->getResultArray():FALSE; 
            } 
        } 
         
        // Return fetched data 
        return $result; 
    } 
     
    /* 
     * Fetch and group by events based on date 
     * @param array filter data based on the passed parameters 
     */ 
    function getGroupCount($params = array()){
        $db = \Config\Database::connect();
        $res = array();
        $start_date = date($params['where_year']."-".$params['where_month']."-01");
        $end_date = date($params['where_year']."-".$params['where_month']."-t");
        $days = date('t', strtotime($end_date));
        for ($i=1; $i <= $days; $i++) { 
            if($i < 10){
                $date = date($params['where_year']."-".$params['where_month']."-0".$i);
            }else{
                $date = date($params['where_year']."-".$params['where_month']."-".$i);
            }
            $builder = $db->table('assignments');
            
            $builder->select("'$date' as date, COUNT(id) as event_num");
            $builder->where('start_date <=', $date);
            $builder->where('end_date >=', $date);
            if(isset($params['where']['id'])){
                $builder->where('assigned_user', $params['where']['id']);
            }

            $query = $builder->get(); 
            $result = ($query->getNumRows() > 0)?$query->getRowArray():FALSE; 
            
            array_push($res, $result);
        }

        return $res;
    } 

}

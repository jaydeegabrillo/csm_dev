<?php

namespace Modules\Timesheet\Models;

use CodeIgniter\Model;

class TimesheetModel extends Model
{
    public function timesheet($id){
        $db = \Config\Database::connect();
        if($id == 0){
            $timesheet = $db->table('daily_logs')->select('date, clock_in, clock_out');
        }else{
            $timesheet = $db->table('daily_logs')->select('date, clock_in, clock_out')->where('user_id', $id);
        }
        return $timesheet;
    }

    public function timesheet_pdf($id,$data=array()){
        $db = \Config\Database::connect();

        if($id == 0){
            $timesheet = $db->table('daily_logs d')->select('date, clock_in, clock_out, a.time_start, a.time_end, CONCAT(c.first_name, " ", c.last_name) AS name')->join('assignments a', 'd.assignment_id = a.id')->where('date >=', $data['start_date'])->where('date <=', $data['end_date'])->join('clients c', 'a.client = c.id')->orderBy('name');
        }else{
            if($data){
                $timesheet = $db->table('daily_logs d')->select('date, clock_in, clock_out, a.time_start, a.time_end, CONCAT(c.first_name, " ", c.last_name) AS name')->where('user_id', $id)->where('date >=', $data['start_date'])->where('date <=', $data['end_date'])->join('assignments a', 'd.assignment_id = a.id')->join('clients c', 'a.client = c.id');
            }else{
                $timesheet = $db->table('daily_logs d')->select('date, clock_in, clock_out, a.time_start, a.time_end, CONCAT(c.first_name, " ", c.last_name) AS name')->where('user_id', $id)->join('assignments a', 'd.assignment_id = a.id')->join('clients c', 'a.client = c.id');
            }
        }

        return $timesheet;
    }

}

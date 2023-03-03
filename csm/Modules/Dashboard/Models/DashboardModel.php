<?php

namespace Modules\Dashboard\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{

    public function log($user_id, $assignment_id, $date = ''){
        $db = \Config\Database::connect();
        $date = ($date == '') ? date('Y-m-d') : $date;

        $sql = "SELECT id, clock_in, clock_out FROM daily_logs WHERE assignment_id = {$assignment_id} AND date = '".$date."'";

        $daily_logs = $db->query($sql)->getRow();

        if($daily_logs){
            if($daily_logs->clock_in == '' || $daily_logs->clock_in == NULL){
                return $db->table('daily_logs')->where('assignment_id', $assignment_id)->where('date', $date)->where('deleted', 0)->update(['clock_in' => date('Y-m-d h:i:s')]);
            }else{
                return $db->table('daily_logs')->where('assignment_id', $assignment_id)->where('date', $date)->where('deleted', 0)->update(['clock_out' => date('Y-m-d h:i:s')]);
            }
        }
    }

    public function check_log($id){
        $db = \Config\Database::connect();

        $sql = "SELECT id,clock_in FROM daily_logs WHERE user_id = {$id} AND clock_out IS NULL AND date = '".date('Y-m-d')."'";

        $daily_logs = $db->query($sql)->getFirstRow();

        if($daily_logs){
            return $daily_logs;
        } else {
            return 0;
        }
    }

    public function delete_log($id){
        $db = \Config\Database::connect();
        $date = date('Y-m-d');

        $sql = "UPDATE daily_logs SET deleted = 1 WHERE assignment_id = $id AND date = '$date'";

        $delete = $db->query($sql);

        if($delete){
            return 1;
        }else{
            return 0;
        }
    }

    public function edit_log($id, $data, $date = ''){
        $db = \Config\Database::connect();
        $date = ($date == '') ? date('Y-m-d') : $date ;
        $update =  $db->table('daily_logs')->where('assignment_id', $id)->where('date', $date)->update($data);

        if($update){
            return 1;
        }else{
            return 0;
        }
    }

    public function user_count(){
        $db = \Config\Database::connect();

        $sql = "SELECT id FROM users WHERE deleted = 0";

        return $db->query($sql)->getNumRows();
    }

    public function timesheet($id = 0, $data = array()){
        $db = \Config\Database::connect();

        $date = ($data['search_date'] != '') ? $data['search_date'] : date('Y-m-d') ;

        if($id == 0){
            $timesheet = $db->table('assignments a')->select('a.id, CONCAT(u.first_name, " ", u.last_name) AS staff_name,CONCAT(c.first_name, " ", c.last_name) AS client_name, CONCAT(a.time_start, " - ",a.time_end) AS time, d.clock_in AS in, d.clock_out AS out, d.date')->join('users u', 'a.assigned_user = u.id')->join('clients c', 'a.client = c.id')->join('daily_logs d', 'a.id = d.assignment_id', 'left')->where('d.date', $date)->where('d.deleted', 0);
        }else{
            $timesheet = $db->table('assignments a')->select('a.id, CONCAT(u.first_name, " ", u.last_name) AS staff_name,CONCAT(c.first_name, " ", c.last_name) AS client_name, CONCAT(a.time_start, " - ",a.time_end) AS time, d.clock_in AS in, d.clock_out AS out, d.date')->join('users u', 'a.assigned_user = u.id')->join('clients c', 'a.client = c.id')->join('daily_logs d', 'a.id = d.assignment_id', 'left')->where('d.date', $date)->where('a.assigned_user', $id)->where('d.deleted', 0);
        }

        return $timesheet;
    }
}

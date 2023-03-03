<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function check_user($data = array()){
        $db = \Config\Database::connect();

        $sql = "SELECT id, CONCAT(u.first_name, ' ', u.last_name) as name, position_id, email FROM users u WHERE u.username = '{$data['username']}' AND u.password = '".$data['password']."' AND deleted = 0";

        $user = $db->query($sql)->getRowArray();

        if($user){
            return $user;
        }else{
            return 0;
        }
    }

    public function user_daily_log($id){
        $db = \Config\Database::connect();
        $date = date('Y-m-d');

        $sql = "SELECT * FROM assignments a WHERE a.start_date <= '$date' AND a.end_date >= '$date' AND assigned_user = $id AND deleted = 0";

        $user_log = $db->query($sql)->getRow();

        if($user_log){
            $log_query = "SELECT id FROM daily_logs WHERE assignment_id = $user_log->id AND date = '$date' AND deleted = 0";
            $log_exists = $db->query($log_query)->getRow();

            if(!$log_exists){
                $insert = array(
                    'user_id' => $user_log->assigned_user,
                    'assignment_id' => $user_log->id,
                    'date' => date('Y-m-d')
                );

                $db->table('daily_logs')->insert($insert);
            }

            return 1;
        }else{
            return 0;
        }
    }
}

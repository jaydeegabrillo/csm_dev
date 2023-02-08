<?php

namespace Modules\Assignments\Models;

use CodeIgniter\Model;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class AssignmentsModel extends Model
{
    protected $db;
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

     /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {
        $this->allowedFields[] = 'middlename';
    }

    public function assignments(){
        $db = \Config\Database::connect();

        return $db->table('assignments a')->select('a.id, CONCAT(u.first_name, " ", u.last_name) AS staff_name, CONCAT(c.first_name, " ", c.last_name) AS client_name, CONCAT(a.start_date, " ", a.end_date) as inclusive_dates, CONCAT(a.time_start, "-", a.time_end) as time')->join('clients c','a.client = c.id')->join('users u', 'a.assigned_user = u.id');
    }

    public function get_assignment($id){
        $db = \Config\Database::connect();

        return $assignment = $db->table('assignments')->where('id', $id)->get()->getResult();
    }

    public function get_user_data($id){
        $db = \Config\Database::connect();

        return $user = $db->table('users u')->where('id', $id)->get()->getResult();
    }

    public function get_clients(){
        $db = \Config\Database::connect();

        return $clients = $db->table('clients')->select('id, CONCAT(first_name, " ", last_name) AS name')->get()->getResult();
    }

    public function get_positions(){
        $db = \Config\Database::connect();

        return $positions = $db->table('position')->select('id,title')->where('id >', 4)->where('deleted',0)->get()->getResult();
    }

    public function get_availability($data = array()){
        $db = \Config\Database::connect();

        return $user = $db->table('users u')->select('u.id, CONCAT(u.first_name, " ", u.last_name) AS name, a.start_date, a.end_date, a.time_start, a.time_end')->join('assignments a', 'a.assigned_user = u.id','left')->where('u.position_id', $data['id'])->get()->getResult();
    }
}

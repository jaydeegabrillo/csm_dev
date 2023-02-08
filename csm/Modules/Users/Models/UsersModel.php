<?php

namespace Modules\Users\Models;

use CodeIgniter\Model;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class UsersModel extends Model
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

    public function users(){
        $db = \Config\Database::connect();
        return $users = $db->table('users u')->select('u.id, CONCAT(u.first_name, " ", u.last_name) AS name, p.title, u.email')->join('position p','u.position_id = p.id', 'left')->where('p.id >', 2);
    }

    public function get_positions(){
        $db = \Config\Database::connect();

        return $position = $db->table('position')->where('deleted', 0)->get()->getResult();
    }

    public function get_user_data($id){
        $db = \Config\Database::connect();

        return $user = $db->table('users u')->where('id', $id)->get()->getResult();
    }
}

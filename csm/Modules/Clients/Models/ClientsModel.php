<?php

namespace Modules\Clients\Models;

use CodeIgniter\Model;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class ClientsModel extends Model
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

    public function clients(){
        $db = \Config\Database::connect();
        return $clients = $db->table('clients c')->select('c.id, CONCAT(c.first_name, " ", c.last_name) AS name, gender, phone, email, marital_status, social_security, ethnicity')->orderBy('c.id', 'ASC');
    }

    public function get_client_data($id){
        $db = \Config\Database::connect();

        return $client = $db->table('clients c')->where('id', $id)->get()->getResult();
    }
}

<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

namespace App\Controllers;
use CodeIgniter\Controller;

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class Login extends Controller
{
    private $CI;
    protected $session;

    function __construct(){
        $this->session = \Config\Services::session();
        $this->session->start();
    }

    public function index()
    {
        $data['title'] = 'Login';
        $script['css_scripts'] = array();
        $script['js_scripts'] = array();
        array_push($script['css_scripts'],'/login/login.css');
        array_push($script['js_scripts'],'/login/login.js');
        echo view('Defaults/login_header',$script);
        echo view('Login/index', $data);
        echo view('Defaults/login_footer', $script);
    }

    public function login(){
        $loginModel = new \App\Models\LoginModel;
        $encrypter = \Config\Services::encrypter();

        $cipher = "AES-256-CBC";
        $secret = "mdsolutions";
        $option = 0;

        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        
        if($this->request->getMethod() == 'get'){     
            $password = $this->request->getVar('password');       
            $data = array(
                'username' => $this->request->getVar('username'),
                'password' => openssl_encrypt($password, $cipher, $secret, $option, $iv),
                'logged_in'=> true
            );
        }

        $validate = $loginModel->check_user($data);
        
        if($validate){
            $data['user_id'] = $validate['id'];
            $data['name'] = $validate['name'];
            $data['email'] = $validate['email'];
            $data['position'] = $validate['position_id'];
            $this->session->set($data);

            $check = $loginModel->user_daily_log($data['user_id']);
            
            echo "true";
        }else{
            echo "false";
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}

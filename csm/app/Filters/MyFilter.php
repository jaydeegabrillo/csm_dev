<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

class MyFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $logged_in = session()->get('logged_in');
        
        if(!isset($logged_in)){
            $login_uri = explode('?', $_SERVER['REQUEST_URI']);
            
            if($login_uri[0] != '/'){
                if($login_uri[0] != '/login'){
                    return redirect()->to(base_url());
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
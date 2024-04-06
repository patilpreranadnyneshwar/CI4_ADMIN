<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use CodeIgniter\Http\Request;

class SigninController extends Controller
{
    protected $session;
    protected $request; // Added property for Request

    public function __construct()
    {
        // Initialize Request object via dependency injection
        //$this->request = $request;

        // Load session library
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // Load form helper
        helper('form');
        echo view('login');
    }

    public function loginAuth()
    {
        $email= $_POST['email'];
        $password= $_POST['password'];
       // echo $password; die;
        // Retrieve form input from Request object
        //$email = $this->request->getPost('email');
        //$password = $this->request->getPost('password');

        // Check if both email and password are provided
        if (!empty($email) && !empty($password)) {
            echo "hii"; die;
            $userModel = new UserModel();

            // Retrieve user data based on email
            $user = $userModel->where('email', $email)->first();

            // Verify if user exists and password matches
            if ($user && password_verify($password, $user['password'])) {
                // Password is correct, set session data
                $userData = [
                    'id' => $user['id'],
                    'firstname' => $user['firstname'],
                    'lastname' => $user['lastname'],
                    'email' => $user['email'],
                    'isLoggedIn' => true
                ];
                $this->session->set($userData);

                // Redirect to 'tables' page if it exists
                return redirect()->to('tables');
            } else {
                // Invalid email or password, set flash message
                $this->session->setFlashdata('msg', 'Invalid email or password');
            }
        } else {
            // Missing email or password, set flash message
            $this->session->setFlashdata('msg', 'Please provide both email and password');
        }

        // Redirect back to 'login' page
        return redirect()->to('login');
    }
}

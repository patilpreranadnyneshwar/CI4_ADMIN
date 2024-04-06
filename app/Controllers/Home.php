<?php

namespace App\Controllers;
use App\Models\UserModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('index');
    }
    public function login(): string
    {
        return view('login');
    }

    public function tables(): string
    {
        return view('tables');
    }

    public function register()
    {
        {
            // Load necessary helpers and libraries
            helper(['form']);
        
            if ($this->request->getMethod() === 'post') {
                // Validate the form input
                if ($this->validate([
                    "firstname" => "required",
                    "lastname" => "required",
                    "email" => "required|valid_email|is_unique[register.email]",
                    "password" => "required|min_length[5]|max_length[20]",
                    "confirmpassword" => "matches[password]"
                ])) {
                    // Registration form submitted successfully
                    $firstname = $this->request->getVar("firstname");
                    $lastname = $this->request->getVar("lastname");
                    $email = $this->request->getVar("email");
                    $password = password_hash($this->request->getVar("password"), PASSWORD_DEFAULT); // Hash password
        
                    // Prepare data for insertion
                    $data = [
                        "firstname" => $firstname,
                        "lastname" => $lastname,
                        "email" => $email,
                        "password" => $password
                    ];
        
                    // Insert data into the database
                    $model = new UserModel();
                    if ($model->insert($data)) {
                        // Data inserted successfully
                        $session = session();
                        $session->setFlashdata("success_message", "User registered successfully");
                        return redirect()->to('login');
                    } else {
                        // Database insert failed
                        $session = session();
                        $session->setFlashdata("error_message", "Failed to register user. Please try again.");
                        return redirect()->back()->withInput();
                    }
                } 
                else {
                    // Form validation failed
                    return redirect()->back()->withInput();
                }
            } 
            else {
                // Redirect to the registration form if accessed directly
                echo view('register');
            }
        }
        
    
       
    
    }


}

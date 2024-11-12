<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function login()
    {
        return view('admin/auth/login');
    }

    public function attemptLogin()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('pass');
        
        $admin = $this->adminModel->where('email', $email)->first();
        
        if ($admin && password_verify($password, $admin['pass'])) {
            $token = bin2hex(random_bytes(16)); // Generate a random token
            session()->set([
                'admin_id' => $admin['id'],
                'admin_email' => $admin['email'],
                'role' => 'admin',
                'token' => $token,
                'logged_in' => true,
            ]);
            return redirect()->to("/admin/dashboard/$token");
        } else {
            return redirect()->back()->with('error', 'Invalid login credentials');
        }
    }

    public function logout()
    {
        $token = null;
        if ($token === session()->get('token')) {
            session()->destroy();
        }
        return redirect()->to('/admin/login');
    }
}
<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        return view('login', ['title' => 'Login']);
    }

    public function authenticate()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('Username', $username)
                      ->where('IsActive', 1)
                      ->where('IsDeleted', 0)   
                      ->first();

        if (password_verify($password, $user['Password'])) {
            session()->set([
                'UserID' => $user['UserID'],
                'Username' => $user['Username'],
                'HotelID' => $user['HotelID'],
                'ProfileImg' => $user['ProfileImg'],
                'logged_in' => true
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function user()
    {
        return view('UserManagement/user', ['title' => 'User Management']);
    }
}

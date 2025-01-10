<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\FillUserTypeModel;

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

        $user = $model->where('userName', $username)
            ->where('isActive', 1)
            ->where('isDeleted', 0)
            ->first();

        if (password_verify($password, $user['password'])) {
            session()->set([
                'userId' => $user['userId'],
                'userName' => $user['userName'],
                'hotelId' => $user['hotelId'],
                'profileImg' => $user['profileImg'],
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
        return redirect()->to('/');
    }

    public function user()
    {
        $model = new UserModel();
        $userTypeModel = new FillUserTypeModel();

        $usertypes = $userTypeModel->findAll();
        $users = $model->getUsersWithUserType();

        return view('UserManagement/user', [
            'title' => 'User Management',
            'users' => $users,
            'usertypes' => $usertypes
        ]);
    }

    public function adduser()
    {
        $model = new UserModel();
        $profileimgname = upload_file('profile');
        $data = [
            'profileImg' => $profileimgname,
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'userName' => $this->request->getPost('username'),
            'userTypeId' => $this->request->getPost('userType'),
            'firstName' => $this->request->getPost('firstname'),
            'middleName' => $this->request->getPost('middlename'),
            'lastName' => $this->request->getPost('lastname'),
            'isActive' => 1,
            'isDeleted' => 0,
            'createdBy' => session()->get('userId'),
            'createdDate' => date('Y-m-d H:i:s'),
            'hostName' => $_SERVER['REMOTE_HOST'],
            'iPAddress' => $_SERVER['REMOTE_ADDR']
        ];

        $model->insert($data);

        return redirect()->to('/user')->with('success', 'User added successfully.');
    }
}

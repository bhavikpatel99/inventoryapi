<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userId';
    protected $allowedFields = [
        'hotelId', 'userTypeId', 'userName', 'password', 
        'isActive', 'isDeleted','profileImg'
    ];
    protected $returnType = 'array';

    protected function initialize()
    {
        $this->where('users.isActive', 1)
             ->where('users.isDeleted', 0);
    }

    public function getUsersWithUserType()
    {
        return $this->select('users.*, usertypes.userType')
                    ->join('usertypes', 'usertypes.userTypeId = users.userTypeId')
                    ->where('users.isActive', 1)
                    ->where('users.isDeleted', 0)
                    ->findAll();
    }
}

class FillUserTypeModel extends Model
{
    protected $table = 'usertypes';
    protected $primaryKey = 'userTypeId';
    protected $allowedFields = ['userType'];
    protected $returnType = 'array';

    protected function initialize()
    {
        $this->where('isActive', 1)
             ->where('isDeleted', 0);
    }
}


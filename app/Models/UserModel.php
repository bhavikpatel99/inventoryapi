<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'UserID';
    protected $allowedFields = [
        'HotelID', 'UserTypeID', 'Username', 'Password', 
        'IsActive', 'IsDeleted','ProfileImg'
    ];
    protected $returnType = 'array';

    protected function initialize()
    {
        $this->where('users.IsActive', 1)
             ->where('users.IsDeleted', 0);
    }

    public function getUsersWithUserType()
    {
        return $this->select('users.*, usertypes.UserType')
                    ->join('usertypes', 'usertypes.UserTypeID = users.UserTypeID')
                    ->where('users.IsActive', 1)
                    ->where('users.IsDeleted', 0)
                    ->findAll();
    }
}

class FillUserTypeModel extends Model
{
    protected $table = 'usertypes';
    protected $primaryKey = 'UserTypeID';
    protected $allowedFields = ['UserType'];
    protected $returnType = 'array';

    protected function initialize()
    {
        $this->where('IsActive', 1)
             ->where('IsDeleted', 0);
    }
}
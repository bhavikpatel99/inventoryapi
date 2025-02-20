<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'userid';
    protected $allowedFields = [
        'referenceid', 'usertype', 'username', 'password', 
        'firstname', 'middlename', 'lastname', 'email', 
        'mobile', 'img', 'isdeleted', 'isactive', 
        'createdby', 'createddate', 'modifyby', 
        'modifydate', 'ipaddress', 'hostname'
    ];
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $deletedField = 'isdeleted';

    protected function initialize()
    {
        $this->where('isactive', true)
             ->where('isdeleted', false);
    }

    public function getUsersWithUserType()
    {
        return $this->select('users.*, usertype.usertype')
                    ->join('usertype', 'usertype.usertypeid = users.usertypeid')
                    ->where('users.isactive', true)
                    ->where('users.isdeleted', false)
                    ->findAll();
    }

    public function getUserById($userId)
    {
        return $this->select('users.*, usertype.usertype')
                    ->join('usertype', 'usertype.usertypeid = users.usertypeid')
                    ->where('users.userid', $userId)
                    ->where('users.isactive', true)
                    ->where('users.isdeleted', false)
                    ->first();
    }

    public function addNewUser($data)
    {
        $this->insert($data);
        return $this->insertID();
    }
}

class FillUserTypeModel extends Model
{
    protected $table = 'usertype';
    protected $primaryKey = 'usertypeid';
    protected $allowedFields = ['usertype'];
    protected $returnType = 'array';

    protected function initialize()
    {
        $this->where('isactive', true)
             ->where('isdeleted', false);
    }
}


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
}

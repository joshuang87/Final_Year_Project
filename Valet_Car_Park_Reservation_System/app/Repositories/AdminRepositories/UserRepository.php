<?php

namespace App\Repositories\AdminRepositories;

use App\Models\User;
use App\Repositories\Interfaces\AdminInterfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getUserInfo()
    {
        return User::all();
    }   

}

?>

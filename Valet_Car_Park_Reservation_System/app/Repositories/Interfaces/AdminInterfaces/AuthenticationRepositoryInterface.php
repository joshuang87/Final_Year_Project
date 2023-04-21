<?php

namespace App\Repositories\Interfaces\AdminInterfaces;

use Illuminate\Http\Request;

interface AuthenticationRepositoryInterface
{
    
    public function checkUser(Request $request); 
}

?>
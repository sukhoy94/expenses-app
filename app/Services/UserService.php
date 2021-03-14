<?php

declare(strict_types=1);


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getLoggedUser(): User
    {
        return Auth::user();    
    }
}
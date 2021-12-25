<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends APIBaseController
{
    public function __construct()
    {
        $this->model = User::class;
    }
}

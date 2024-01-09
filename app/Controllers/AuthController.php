<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function index(): string
    {
        return view('user/index');
    }

    public function profile(): string
    {
        return view('user/profile');
    }
    public function saved(): string
    {
        return view('user/profileSecondary');
    }
}
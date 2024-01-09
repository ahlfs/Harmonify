<?php

namespace App\Controllers;

class UserController extends BaseController
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

    public function post(): string
    {
        return view('user/post');
    }
}

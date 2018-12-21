<?php

use Core\Controller;

class UserController extends Controller
{
    public function create()
    {
        $user = new App\User();
        $user->email = $_POST['email'];
        var_dump($user);
    }

    public function register()
    {
        return view('user/registration');
    }
}

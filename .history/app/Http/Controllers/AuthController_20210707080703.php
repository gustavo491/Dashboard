<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function Login(){
        return view('admin/login');
    }

    public function sign(){
        $email = $_POST['email'];
        $password = $_POST['passsword'];
        
        exit;
        }
}

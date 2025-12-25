<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomloginController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return Auth::user()->usertype == 'admin' ? redirect()->route('dummyadmin') : redirect()->route('dummyuser');
        }

        return redirect()->route('login');
    }
}

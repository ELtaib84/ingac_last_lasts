<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function whoare()
    {
        return view('user.whoare');
    }
    public function contact()
    {
        return view('user.contact');
    }
    public function service()
    {
        return view('user.service');
    }

}

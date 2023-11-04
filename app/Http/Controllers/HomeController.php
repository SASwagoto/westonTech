<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    
    public function index()
    {
        return view("home");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        return view('order.create');
    }
    
    public function store(Request $request)
    {
        return  $request;
    }
}

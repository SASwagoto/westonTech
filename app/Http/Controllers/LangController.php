<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index($lang)
    {
        App::SetLocale($lang);
        session()->put('lang_code',$lang);
       // return $lang;
        return  redirect()->back()->with(['message'=>'Langulage Change Successfully']);
    }
}

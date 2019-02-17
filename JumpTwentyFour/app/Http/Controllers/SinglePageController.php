<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    
    
    
    public function home() {
        return view('app');
    }
}

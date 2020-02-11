<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function index(){
        $foods = Food::latest()->paginate(10);
        return view('welcome',compact('foods'));
        
    }
}

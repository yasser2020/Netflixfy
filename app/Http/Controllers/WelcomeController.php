<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Category;
class WelcomeController extends Controller
{
    public function index()
    {
        $latest_movies=Movie::latest()->limit(2)->get();
        $categories=Category::with('movies')->get();
        return view('welcome',compact('latest_movies','categories'));
    }
}

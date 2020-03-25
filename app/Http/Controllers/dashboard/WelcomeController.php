<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Movie;

class WelcomeController extends Controller
{
    public function index()
    {
        $users_count=User::whereRole('user')->count();
        $categories_count=Category::count();
        $movies_count=Movie::where('percent',99)->count();
        return view('dashboard.welcome',compact('users_count','movies_count','categories_count'));
    }
}

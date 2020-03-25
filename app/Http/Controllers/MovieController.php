<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;

class MovieController extends Controller
{
    public function index()
    {
        
    }
    public function show(Movie $movie)
    {
        
        $related_movies=Movie::where('id','!=',$movie->id)
        ->whereHas('categories',function($qury)use($movie){
            return $qury->whereIn('category_id',$movie->categories->pluck('id')->toArray());
        })->get();
        
        return view('movies.show',compact('movie','related_movies'));
    }
    public function increment_views(Movie $movie)
    {
        $movie->increment('views');
    }
     public function toggle_favorite(Movie $movie)
     {
         $movie->is_favored? $movie->users()->detach(auth()->user()->id): $movie->users()->attach(auth()->user()->id);
       
     }
}

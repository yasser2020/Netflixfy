<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
use App\Jobs\StreamMovie;
use App\Category;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
class MovieController extends Controller
{
    public function __construct()
    {
     $this->middleware('permission:read_movies')->only('index');   
     $this->middleware('permission:create_movies')->only(['create','store']); 
     $this->middleware('permission:update_movies')->only(['edit','update']); 
     $this->middleware('permission:delete_movies')->only(['destory']); 
    }
    public function index(Request $request)
    { 
        $categories=Category::all();
        $movies=Movie::whenSearch(request()->search)->whenCategory(request()->category)->with('categories')->paginate(5);
        return view('dashboard.movies.index',compact('movies','categories'));
    }

   
    public function create()
    {
        $categories=Category::all();
        $movie=Movie::create([]);
        return view('dashboard.movies.create',compact('movie','categories'));
    }

  
    public function store(Request $request)
    {
       $movie=Movie::findOrFail($request->movie_id);
       $movie->update([
               'name'=>$request->name,
               'path'=>$request->file('movie')->store('movies'),
       ]);

       //i want to run a job to encoding in the background
          $this->dispatch(new StreamMovie($movie));
        return $movie;
    }

    public function show(Movie $movie)
    {
        return $movie;
    }


    public function edit(Movie $movie)
    {
        $categories=Category::all();
        return view('dashboard.movies.edit',compact('movie','categories'));
    }

    public function update(Request $request, Movie $movie)
    {

       if($request->type=='publish')
       {
           //publish
        $request->validate([
            'name'=>'required|unique:movies,name,'.$movie->id,
            'description'=>'required',
            'poster'=>'required|image',
            'image'=>'required|image',
            'categories'=>'required|array',
            'year'=>'required',
            'rating'=>'required'
        ]);
       }
       else
       {
           //update
        $request->validate([
            'name'=>'required|unique:movies,name,'.$movie->id,
            'description'=>'required',
            'poster'=>'sometimes|nullable|image',
            'image'=>'sometimes|nullable|image',
            'categories'=>'required|array',
            'year'=>'required',
            'rating'=>'required'
        ]);
       }

       $request_data=$request->except(['poster','image']);
       if($request->poster)
       {
        $this->remove_previews('poster',$movie);
        $poster=Image::make($request->poster)
        ->resize(255,378)
        ->encode('jpg');
        Storage::disk('local')->put('public/images/'.$request->poster->hashName(),(string)$poster,'public');
        $request_data['poster']=$request->poster->hashName();
       }
       if($request->image)
       {
        $this->remove_previews('image',$movie); 
        $image=Image::make($request->image)
        ->encode('jpg',50);
        Storage::disk('local')->put('public/images/'.$request->image->hashName(),(string)$image,'public');
        $request_data['image']=$request->image->hashName();
       }
       
         
        $movie->update($request_data);
        $movie->categories()->sync($request->categories);
        session()->flash('success','Data Updated Successfully');
        return redirect()->route('dashboard.movies.index');

    }

    private function remove_previews($image_type,$movie)
    {
        if($image_type=='poster')
        {
            if($movie->poster !=null)
                Storage::disk('local')->delete('public/images/'.$movie->poster);
        }
        else
        {
            if($movie->image !=null)
                Storage::disk('local')->delete('public/images/'.$movie->image);

        }
    }
    
    public function destroy(Movie $movie)
    {
        Storage::disk('local')->delete('public/images/'.$movie->poster);
        Storage::disk('local')->delete('public/images/'.$movie->image);
        Storage::disk('local')->deleteDirectory('public/movies/'.$movie->id);
        Storage::disk('local')->delete($movie->path);
        $movie->delete();
        session()->flash('success','Data Deleted Successfully');
        return redirect()->route('dashboard.movies.index');

    }
}

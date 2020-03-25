<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use Illuminate\Support\Facades\Storage;
class Movie extends Model
{
    protected $fillable=[
        'name','description','path','year','rating','poster','image','percent'
    ];

    protected $appends=['poster_path','image_path','is_favored'];

      //Scope Search -------------------------->
   public function scopeWhenSearch($query,$search){

            return $query->when($search,function($q)use($search){
                return $q->where('name','like',"%$search%")
                ->orWhere('description','like',"%$search%")
                ->orWhere('year','like',"%$search%")
                ->orWhere('rating','like',"%$search%");
            });
        }
       
        public function scopeWhenCategory($query,$category)
        {
            return $query->when($category,function($q)use($category){
                return $q->whereHas('categories',function($qu)use($category){
                  return $qu->whereIn('category_id',(array)$category)
                  ->orWhereIn('name',(array)$category);
                });
            });
        }

        public function getIsFavoredAttribute()
        {
            if(auth()->user())
            {
                  return (bool)$this->users()->where('user_id',auth()->user()->id)->count();
            }
           return false;
        }
    //relations
    public function categories()
    {
        return $this->belongsToMany(Category::class,'movie_category');
    }
    public function users()
    {
       return $this->belongsToMany(User::class,'user_movie');
    }

    public function getPosterPathAttribute()
    {
        return Storage::url('images/'.$this->poster);
    }

    public function getImagePathAttribute()
    {
        return Storage::url('images/'.$this->image);
    }
    public function FunctionName(Type $var = null)
    {
        # code...
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movie;

class Category extends Model
{
    protected $fillable=['name'];

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    //Scope Search -------------------------->
   public function scopeWhenSearch($query,$search){
       return $query->when($search,function($q)use($search){
            return $q->where('name','like',"%$search%");
       });
   }

   //relations

   public function movies()
   {
       return $this->belongsToMany(Movie::class,'movie_category');
   }
}

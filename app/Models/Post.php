<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    //eager loading by default
    // untuk menyertakan table category dan table user ketika table post dibaca
    protected $with = ['category', 'author'];

    //Local Scopes
    public function scopeFilter($query, array $filters){

      // method "when" will executed callback when the first argument given to the method value to treu
      // method ini akan mengeksekusi callback ketika argumen/ pertema memberi nilai true
      $query->when($filters['search'] ?? false, function($query, $search) {
        return $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('body', 'like', '%' . $search . '%');
      });

      $query->when($filters['category'] ?? false, function($query, $category) {
        // whereHas() untuk mengembalikan relasi pada table
        return $query->whereHas('category', function($query) use($category){
          $query->where('slug',$category);
        });
      });

      $query->when($filters['author'] ?? false, function($query, $author) {
        return $query->whereHas('author', function($query) use($author){
          $query->where('username', $author);
        });
      });

    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    protected $with = ['category', 'author']; //! to utilise eager loading

    protected $guarded = ['id'];
    // protected $fillable = ['title', 'body', 'excerpt'];

    public function category()
    {
        // types of relation: hasMany, hasOne, belongsTo, belongsToMany
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search'])) {
        //     $query
        //         ->where('title', 'like', '%' . request('search') . '%')
        //         ->orWhere('body', 'like', '%' . request('search') . '%');
        // }

        //? query to search the posts where search term matches those in the title and body of the post
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query
                ->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%');
                });
        });

        //? query to get all the posts which has category equal to the slug in uri
        $query->when($filters['category'] ?? false, function ($query, $category) {
            // $query->whereExists(function ($query) use ($category) {
            //     $query
            //         ->from('categories')
            //         ->whereColumn('id', 'posts.category_id')
            //         ->where('categories.slug', $category);
            // });

            $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        //? to get the posts with the author matching the username in the uri
        $query->when($filters['author'] ?? false, function ($query, $author) {
            $query->whereHas('author', function ($query) use ($author) {
                $query->where('username', $author);
            });
        });
    }
}

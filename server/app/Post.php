<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title', 
        'subtitle', 
        'category_id',
        'image',
        'meta_desc',
        'post_body',
        'user_id',
        'image_large',
        'image_medium',
        'image_thumbnail'
    ];

   /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

   public function user() {
       return $this->belongsTo(User::class);
   }

   public function category() {
       return $this->belongsTo(Category::class);
   }
   public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getThreadedComments(){
        return $this->comments()->with('user')->get();
    }

    public function addComment($attributes)
    {
        $comment = (new Comment())->forceFill($attributes);
        $comment->user_id = auth()->id();
        return $this->comments()->save($comment);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = 'posts';

    protected $attributes = [
        'status' => 'pending'
    ];

    protected $fillable = [
        'title',
        'content',
        'status'
    ];

    protected $dates = [
    	'created_at',
    	'updated_at',
    	'deleted_at'
    ];

    public function editPath()
    {
        return 'AdminPostController@editPost';
    }

    public function image()
    {
        return $this->hasOne('App\Image', 'post_id');
    }

    public function category()
    {
        return $this->belongsToMany('App\Category');
    }

    public function comment()
    {
        //return $this->morphMany('App\Comment', 'commentable')->where('parent_id', 0);
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function commentFront()
    {
        return $this->morphMany('App\Comment', 'commentable')->where('status', 'published');
    }
   
}

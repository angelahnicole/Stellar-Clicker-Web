<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// ===============================================================================================================
// Blog Post
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// An Eloquent model that represents a blog post in the stellar clicker database
// ===============================================================================================================

class BlogPost extends Model
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blog_posts';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    [
        'title_text', 'body_text'
    ];
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Get the user that this blog post belongs to 
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    /**
     * Get the comments associated with the blog post
     */
    public function comments()
    {
        return $this->hasMany('App\Models\BlogComment', 'blog_post_id', 'id');
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

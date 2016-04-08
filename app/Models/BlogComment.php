<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// ===============================================================================================================
// Blog Comment
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// An Eloquent model that represents a blog comment in the stellar clicker database
// ===============================================================================================================

class BlogComment extends Model
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stellar_blog_comment';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    [
        'body_text', 'blog_post_id', 'blog_comment_parent_id', 'user_id'
    ];
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Get the user that this comment belongs to 
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
    /**
     * Get the blog post that this comment belongs to
     */
    public function blogPost()
    {
        return $this->belongsTo('App\Models\BlogPost', 'blog_post_id', 'id');
    }
    
    /**
     * Get the children comments
     */
    public function children()
    {
        return $this->hasMany('App\Models\BlogComment', 'blog_comment_parent_id', 'id');
    }
    
    /**
     * Get the comment that is the parent of this one
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\BlogComment', 'blog_comment_parent_id', 'id');
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

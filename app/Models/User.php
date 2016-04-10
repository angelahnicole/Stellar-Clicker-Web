<?php

namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser as CartalystUser;

// ===============================================================================================================
// User
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// An Eloquent model that represents a user in the stellar clicker database
// ===============================================================================================================

class User extends CartalystUser
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    [
        'email',
        'username', 
        'password',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = 
    [
        'password'
    ];
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Get the comments written by the user
     */
    public function comments()
    {
        return $this->hasMany('App\Models\BlogComment', 'user_id', 'id');
    }
    
    /**
     * Get the blog posts written by the user
     */
    public function blogPosts()
    {
        return $this->hasMany('App\Models\BlogPost', 'user_id', 'id');
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

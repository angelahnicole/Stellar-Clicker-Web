<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

// ===============================================================================================================
// User
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// An Eloquent model that represents a user in the stellar clicker database
// ===============================================================================================================

class User extends Authenticatable
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stellar_user';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    [
        'name', 'email', 'password',
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
     * Get the group that the user belongs to
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }
    
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

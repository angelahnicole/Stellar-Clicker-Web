<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// ===============================================================================================================
// Group
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// An Eloquent model that represents a user group in the stellar clicker database
// ===============================================================================================================

class Group extends Model
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stellar_group';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = 
    [
        'name', 'manage_users', 'blog_post', 'blog_comment'
    ];
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Get the users that belong to this group
     */
    public function users()
    {
        return $this->hasMany('App\Models\User', 'group_id', 'id');
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

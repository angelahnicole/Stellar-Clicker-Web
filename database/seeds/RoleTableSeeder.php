<?php

use Illuminate\Database\Seeder;

// ===============================================================================================================
// Role Table Seeder
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Creates the four different permission user groups for the database.
// ===============================================================================================================

class RoleTableSeeder extends Seeder
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // CREATE ADMINISTRATOR
        Sentinel::getRoleRepository()->createModel()->create
        ([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => 
            [
                'api.post.comment.store' => true,
                'api.post.comment.update' => true,
                'api.post.comment.destroy' => true,
                'blog::post.manage' => true,
                'blog::post.store' => true,
                'blog::post.create' => true,
                'blog::post.destroy' => true,
                'blog::post.update' => true,
                'blog::post.edit' => true,
                'blog::user.manage' => true,
                'blog::user.store' => true,
                'blog::user.create' => true,
                'blog::user.destroy' => true,
                'blog::user.update' => true,
                'blog::user.edit' => true
            ],
        ]);
        
        // CREATE BLOGGER
        Sentinel::getRoleRepository()->createModel()->create
        ([
            'name' => 'Blogger',
            'slug' => 'blogger',
            'permissions' => 
            [
                'blog::post.manage' => true,
                'blog::post.store' => true,
                'blog::post.create' => true,
                'blog::post.destroy' => true,
                'blog::post.update' => true,
                'blog::post.edit' => true,
            ],
        ]);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

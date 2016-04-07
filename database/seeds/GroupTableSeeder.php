<?php

use Illuminate\Database\Seeder;

// ===============================================================================================================
// Group Table Seeder
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Creates the four different permission user groups for the database.
// ===============================================================================================================

class GroupTableSeeder extends Seeder
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Group::create
        ([
            'name' => 'admin',
            'manage_users' => true,
            'manage_blog_posts' => true,
            'blog_post' => true,
            'blog_comment' => true
        ]);
        
        App\Models\Group::create
        ([
            'name' => 'blogger',
            'manage_users' => false,
            'manage_blog_posts' => false,
            'blog_post' => true,
            'blog_comment' => true
        ]);
        
        App\Models\Group::create
        ([
            'name' => 'user',
            'manage_users' => false,
            'manage_blog_posts' => false,
            'blog_post' => false,
            'blog_comment' => true
        ]);
        
        App\Models\Group::create
        ([
            'name' => 'throttled_user',
            'manage_users' => false,
            'manage_blog_posts' => false,
            'blog_post' => false,
            'blog_comment' => false
        ]);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

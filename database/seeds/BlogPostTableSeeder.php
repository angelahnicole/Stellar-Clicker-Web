<?php

use Illuminate\Database\Seeder;

// ===============================================================================================================
// Blog Post Table Seeder
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Seeds the database with blog posts posted by users that belong to the admin and blogger group using the Model
// Factory. Note that you have to have some admin and blogger users created in order for this to properly seed.
// ===============================================================================================================

class BlogPostTableSeeder extends Seeder
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get roles
        $adminRole = Sentinel::findRoleByName('Admin');
        $bloggerRole = Sentinel::findRoleByName('Blogger');
        
        // Get admins and bloggers
        $adminUsers = $adminRole->users()->with('roles')->get();
        $bloggerUsers = $bloggerRole->users()->with('roles')->get();
        
        // Create blog posts for the admin and blogger users
        $adminUsers->each(function($user)
        {
            $user->blogPosts()->saveMany(factory(App\Models\BlogPost::class, 3)->make());
        });
        $bloggerUsers->each(function($user)
        {
            $user->blogPosts()->saveMany(factory(App\Models\BlogPost::class, 5)->make());
        });
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

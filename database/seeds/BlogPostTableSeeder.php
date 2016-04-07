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
        // Get admins and bloggers
        $adminID = App\Models\Group::where('name', 'admin')->first()->id;
        $bloggerID = App\Models\Group::where('name', 'blogger')->first()->id;
        $adminUsers = App\Models\User::where('group_id', $adminID)->get();
        $bloggerUsers = App\Models\User::where('group_id', $bloggerID)->get();
        
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

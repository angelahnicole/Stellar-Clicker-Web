<?php

use Illuminate\Database\Seeder;

// ===============================================================================================================
// Database Seeder
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// 
// ===============================================================================================================

class DatabaseSeeder extends Seeder
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create predefined user groups
        $this->call(RoleTableSeeder::class);
        
        // Create users
        $this->call(UserTableSeeder::class);
        
        // Create blog posts from admins and bloggers
        $this->call(BlogPostTableSeeder::class);
        
        // Create comments to those blog posts
        $this->call(BlogCommentTableSeeder::class);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

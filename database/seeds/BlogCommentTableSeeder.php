<?php

use Illuminate\Database\Seeder;

// ===============================================================================================================
// Blog Comment Table Seeder
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Seeds the database with comments for each blog post (some will be parents and the children will not). Note that
// all of the other seeders should probably be ran before this in order to ensure correctness.
// ===============================================================================================================

class BlogCommentTableSeeder extends Seeder
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create comments for each blog post
        foreach(App\Models\BlogPost::all() as $blogPost)
        {
            $blogPost->comments()
                     ->saveMany(factory(App\Models\BlogComment::class, rand(2, 6))
                     ->make(['blog_post_id' => $blogPost->id]));
            
            // Make the comments a tiny bit nested
//            foreach($blogPost->comments as $comment)
//            {
//                // Nesting every comment for testing
//                $comment->children()
//                        ->saveMany(factory(App\Models\BlogComment::class, rand(2, 5))
//                        ->make(['blog_post_id' => $blogPost->id, 'blog_comment_parent_id' => $comment->id]));
//            }
        }
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

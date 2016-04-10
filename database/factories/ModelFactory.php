<?php

// ===============================================================================================================
// Model Factories
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Here you may define all of your model factories. Model factories give you a convenient way to create models 
// for testing and seeding your database. Just tell the factory how a default model should look.
// ===============================================================================================================

// ------------------------------------------------------------------------------------------------------
// USERS
// ------------------------------------------------------------------------------------------------------
$factory->define(App\Models\User::class, function (Faker\Generator $faker) 
{
    return 
    [
        'email' => $faker->safeEmail,
        'username' => $faker->userName,
        'password' => bcrypt('secret'),
    ];
});

// ------------------------------------------------------------------------------------------------------
// BLOG_POSTS: Made to be created after users are created.
// ------------------------------------------------------------------------------------------------------
$factory->define(App\Models\BlogPost::class, function (Faker\Generator $faker) 
{
    
    return 
    [
        'title_text' => $faker->words(3, true),
        'body_text' => $faker->paragraphs(20, true),
        'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
    ];
});

// ------------------------------------------------------------------------------------------------------
// BLOG_COMMENTS: Made to be created after posts and users are created. Uses a random pre-existing
// user as the author of this comment.
// ------------------------------------------------------------------------------------------------------
$factory->define(App\Models\BlogComment::class, function (Faker\Generator $faker) 
{
    return 
    [
        'body_text' => $faker->paragraphs(3, true),
        'blog_comment_parent_id' => NULL,
        'blog_post_id' => 1,
        'created_at' => $faker->dateTimeBetween('-1 years', 'now'),
        'user_id' => function()
        {
            $userCount = App\Models\User::all()->count();
            return App\Models\User::find(rand(1, $userCount))->id;
        }
    ];
});

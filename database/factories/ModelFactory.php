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
// STELLAR_USER (admin user)
// ------------------------------------------------------------------------------------------------------
$factory->defineAs(App\Models\User::class, 'admin', function (Faker\Generator $faker) 
{
    return 
    [
        'email' => $faker->safeEmail,
        'username' => $faker->userName,
        'password' => bcrypt('secret'),
        'group_id' => function()
        {
            return App\Models\Group::where('name', 'admin')->first()->id; 
        }
    ];
});

// ------------------------------------------------------------------------------------------------------
// STELLAR_USER (normal user)
// ------------------------------------------------------------------------------------------------------
$factory->defineAs(App\Models\User::class, 'normal', function (Faker\Generator $faker) 
{
    return 
    [
        'email' => $faker->safeEmail,
        'username' => $faker->userName,
        'password' => bcrypt('normal'),
        'group_id' => function()
        {
            return App\Models\Group::where('name', 'user')->first()->id; 
        }
    ];
});

// ------------------------------------------------------------------------------------------------------
// STELLAR_USER (blog posting user)
// ------------------------------------------------------------------------------------------------------
$factory->defineAs(App\Models\User::class, 'blogger', function (Faker\Generator $faker) 
{
    return 
    [
        'email' => $faker->safeEmail,
        'username' => $faker->userName,
        'password' => bcrypt('blogger'),
        'group_id' => function()
        {
            return App\Models\Group::where('name', 'blogger')->first()->id; 
        }
    ];
});

// ------------------------------------------------------------------------------------------------------
// STELLAR_USER (throttled user)
// ------------------------------------------------------------------------------------------------------
$factory->defineAs(App\Models\User::class, 'throttled', function (Faker\Generator $faker) 
{
    return 
    [
        'email' => $faker->safeEmail,
        'username' => $faker->userName,
        'password' => bcrypt('throttled'),
        'group_id' => function()
        {
            return App\Models\Group::where('name', 'throttled_user')->first()->id; 
        }
    ];
});

// ------------------------------------------------------------------------------------------------------
// STELLAR_BLOG_POST: Made to be created after users are created.
// ------------------------------------------------------------------------------------------------------
$factory->define(App\Models\BlogPost::class, function (Faker\Generator $faker) 
{
    return 
    [
        'title_text' => $faker->words(3, true),
        'body_text' => $faker->paragraphs(20, true),
    ];
});

// ------------------------------------------------------------------------------------------------------
// STELLAR_BLOG_COMMENT: Made to be created after posts and users are created. Uses a random pre-existing
// user as the author of this comment.
// ------------------------------------------------------------------------------------------------------
$factory->define(App\Models\BlogComment::class, function (Faker\Generator $faker) 
{
    return 
    [
        'body_text' => $faker->paragraphs(3, true),
        'blog_comment_parent_id' => NULL,
        'blog_post_id' => 1,
        'user_id' => function()
        {
            $userCount = App\Models\User::all()->count();
            return App\Models\User::find(rand(1, $userCount))->id;
        }
    ];
});

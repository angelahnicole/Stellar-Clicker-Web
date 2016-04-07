<?php

use Illuminate\Database\Seeder;

// ===============================================================================================================
// User Table Seeder
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Creates admin, blogger, normal, and throttled users using the Model Factory. Note that the GroupTableSeeder 
// should be ran before this one.
// ===============================================================================================================

class UserTableSeeder extends Seeder
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create random users
        $adminUsers = factory(App\Models\User::class, 'admin', 2)->create();
        $bloggerUsers = factory(App\Models\User::class, 'blogger', 5)->create();
        $normalUsers = factory(App\Models\User::class, 'normal', 30)->create();
        $throttledUsers = factory(App\Models\User::class, 'throttled', 5)->create();
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

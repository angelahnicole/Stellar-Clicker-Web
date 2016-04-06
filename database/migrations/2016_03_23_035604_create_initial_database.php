<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// ===============================================================================================================
// CreateInitialDatabase
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker Web: Blog
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Creates the database schema for the blog
// ===============================================================================================================

class CreateInitialDatabase extends Migration
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('users');
        Schema::dropIfExists('users');
        
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

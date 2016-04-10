<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

// ===============================================================================================================
// CreateInitialDatabase
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // ------------------------------------------------------------------------------------------------------
        // BLOG_POSTS -> Drop table and create it
        // ------------------------------------------------------------------------------------------------------
        Schema::dropIfExists('blog_posts');
        Schema::create('blog_posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('title_text');
            $table->text('body_text');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
        
        // ------------------------------------------------------------------------------------------------------
        // BLOG_COMMENTS -> Drop table and create it
        // ------------------------------------------------------------------------------------------------------
        Schema::dropIfExists('blog_comments');
        Schema::create('blog_comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('blog_post_id')->unsigned();
            $table->integer('blog_comment_parent_id')->unsigned()->nullable();
            $table->text('body_text');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('blog_post_id')->references('id')->on('blog_posts');
            $table->foreign('blog_comment_parent_id')->references('id')->on('blog_comments');
        });
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Drops all the tables in the proper order to avoid an integrity constraint violation
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('blog_comments');
        Schema::dropIfExists('blog_posts');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

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
        // ------------------------------------------------------------------------------------------------------
        // STELLAR_GROUP -> Drop table and create it
        // ------------------------------------------------------------------------------------------------------
        Schema::dropIfExists('stellar_group');
        Schema::create('stellar_group', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('manage_users')->default(false);
            $table->boolean('manage_blog_posts')->default(false);
            $table->boolean('blog_post')->default(false);
            $table->boolean('blog_comment')->default(false);
            $table->timestamps();
        });
        
        // ------------------------------------------------------------------------------------------------------
        // STELLAR_USER -> Drop table and create it
        // ------------------------------------------------------------------------------------------------------
        Schema::dropIfExists('stellar_user');
        Schema::create('stellar_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->string('email')->unique();
            $table->string('username', 100)->unique();
            $table->string('password', 100);
            $table->timestamps();
            
            $table->foreign('group_id')->references('id')->on('stellar_group');
        });
        
        // ------------------------------------------------------------------------------------------------------
        // STELLAR_BLOG_POST -> Drop table and create it
        // ------------------------------------------------------------------------------------------------------
        Schema::dropIfExists('stellar_blog_post');
        Schema::create('stellar_blog_post', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->text('title_text');
            $table->text('body_text');
            $table->string('slug_text', 100)->unique();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('stellar_user');
        });
        
        // ------------------------------------------------------------------------------------------------------
        // STELLAR_BLOG_COMMENT -> Drop table and create it
        // ------------------------------------------------------------------------------------------------------
        Schema::dropIfExists('stellar_blog_comment');
        Schema::create('stellar_blog_comment', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('blog_post_id')->unsigned();
            $table->integer('blog_comment_parent_id')->unsigned()->nullable();
            $table->text('body_text');
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('stellar_user');
            $table->foreign('blog_post_id')->references('id')->on('stellar_blog_post');
            $table->foreign('blog_comment_parent_id')->references('id')->on('stellar_blog_comment');
        });
    }

    /**
     * Drops all the tables in the proper order to avoid an integrity constraint violation
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('stellar_blog_comment');
        Schema::dropIfExists('stellar_blog_post');
        Schema::dropIfExists('stellar_user');
        Schema::dropIfExists('stellar_group');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

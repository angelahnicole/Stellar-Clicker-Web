<?php

// ================================================================================================================================
// routes.php
// --------------------------------------------------------------------------------------------------------------------------------
// Polymorphix Gaming: Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// @author Angela Gross
// --------------------------------------------------------------------------------------------------------------------------------
// Routes to direct web application to desired views.
// ================================================================================================================================

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::group(['middleware' => ['web', 'sentinel.auth']], function () 
{
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // --------------------------------------------------------------------------------------------------------------------------
    // BLOG SUBDOMAIN
    // --------------------------------------------------------------------------------------------------------------------------
    Route::group(['domain' => 'blog.stellar.polymorphixgaming.com'], function () 
    {
        // -------------------------------------------------------------------------------
        // MAIN BLOG ROUTES
        // -------------------------------------------------------------------------------
        Route::group(['as' => 'blog::'], function () 
        {
            Route::get('', 'PostController@index')->name('home');
            
            // ---------------------------------------------------------------------------
            // POST RESOURCE CONTROLLER
            // Contains routes for index, create, store, show, edit, update, and destroy
            // ---------------------------------------------------------------------------
            Route::resource('post', 'PostController');
            Route::get('post/manage/all', 'PostController@manage')->name('post.manage');
            
            // ---------------------------------------------------------------------------
            // USER RESOURCE CONTROLLER
            // Handles logging in, registering, redirecting users to their home page, and
            // contains routes for create, store, edit, update, and destroy
            // ---------------------------------------------------------------------------
            Route::resource("user", "UserController", ['except' => ['show', 'index', 'create']]);
            Route::group(['as' => 'user.'], function () 
            {
                // Logging in and out
                Route::get('user/login', 'UserController@login')->name('login');
                Route::post('user/login', 'UserController@validateLogin')->name('validateLogin');
                Route::get('user/logout', 'UserController@logout')->name('logout');
                
                // Password reset
                Route::get('user/password/email', 'UserController@createReset')->name('createReset');
                Route::post('user/password/email', 'UserController@storeReset')->name('storeReset');
                Route::get('user/password/reset/{id}/{token}', 'UserController@editPassword')->name('editPassword');
                Route::post('user/password/reset/{id}/{token}', 'UserController@updatePassword')->name('updatePassword');
                
                // User administration
                Route::get('user/manage/all', 'UserController@manage')->name('manage');
            });
        });
        
        // -------------------------------------------------------------------------------
        // API ROUTES
        // -------------------------------------------------------------------------------
        Route::group(['prefix' => 'api'], function () 
        {
            // ---------------------------------------------------------------------------
            // POST COMMENT RESOURCE CONTROLLER
            // Contains nested resource routes for index, store, update, and destroy
            // ---------------------------------------------------------------------------
            Route::resource('post.comment', 'PostCommentController', ['except' => ['create', 'edit', 'show']]);
        });
        
    });
    
    // --------------------------------------------------------------------------------------------------------------------------
    // WIKI SUBDOMAIN
    // --------------------------------------------------------------------------------------------------------------------------
    Route::group(['domain' => 'wiki.stellar.polymorphixgaming.com'], function () 
    {
        Route::group(['as' => 'wiki::'], function () 
        {
            Route::get('', 'HomeController@wikiHome')->name('home');
        });
    });

    // --------------------------------------------------------------------------------------------------------------------------
    // STELLAR CLICKER SUBDOMAIN
    // --------------------------------------------------------------------------------------------------------------------------
    Route::group(['domain' => 'stellar.polymorphixgaming.com'], function () 
    {
        Route::group(['as' => 'stellar::'], function () 
        {
            Route::get('', 'HomeController@stellarHome')->name('home');
        });
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



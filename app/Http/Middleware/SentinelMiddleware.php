<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\BaseController;
use App\Models\BlogComment;

// ===============================================================================================================
// Post Comment Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// This controller works with the jQuery comments library to get, create, edit, and delete comments.
// ===============================================================================================================

class SentinelMiddleware
{
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Array of actions that all users (even guests) can access
     *
     * @var array
     */
    protected $freeActions = 
    [
        'wiki::home',
        'stellar::home',
        'blog::home',
        'api.post.comment.index',
        'blog::user.home',
        'blog::post.index',
        'blog::post.show',
        'blog::user.login',
        'blog::user.validateLogin',
        'blog::user.logout',
        'blog::user.store',
        'blog::user.createReset',
        'blog::user.storeReset',
        'blog::user.editPassword',
        'blog::user.updatePassword'
    ];
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = \Route::getCurrentRoute()->getName();
        $user = \Sentinel::check();

        // Check to make sure that it's a "free action", or an action that all users,
        // even gusts, can execute.
        if(in_array($action, $this->freeActions))
        {
            return $next($request);
        }

        // Check to make sure if logged in user can do the given action
        if ($user && \Sentinel::hasAccess($action))
        {
            return $next($request);
        }
       
        
        // Make sure that the currently logged in user is the user that owns the resource
        // that we're modifying.
        if($user)
        {
            // Modifying a user
            if($request->user && $request->user == $user->id)
            {
                return $next($request);
            }
            
            // Allow a logged in user to create a comment with their credentials
            if($action === 'api.post.comment.store')
            {
                return $next($request);
            }
            // Allow a logged in user to update / destroy a comment only if the comment belongs to them
            elseif($request->comment && ($action == 'api.post.comment.update' || $action == 'api.post.comment.destroy'))
            {
                $comment = BlogComment::find($request->comment);

                if($comment && $comment->user->id == $user->id)
                {
                    return $next($request);
                }
            }
        }

        // Return a response if it's ajax or wants JSON
        if ($request->ajax() || $request->wantsJson()) 
        {
            return response('Unauthorized.', 401);
        } 
        // Otherwise, redirect back
        else 
        {
            BaseController::addNotification('Permission Denied', 'error');
            
            return back()->withErrors('Permission Denied.');
        }
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

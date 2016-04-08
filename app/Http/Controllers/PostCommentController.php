<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use App\Models\BlogComment;
use App\Models\Group;

// ===============================================================================================================
// Post Comment Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// This controller works with the jQuery comments library to get, create, edit, and delete comments.
// ===============================================================================================================

class PostCommentController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    /**
     * Returns all comments associated with the given post.
     *
     * @param int $post Post ID
     * 
     * @return Response HTTP response with the blog comments
     */
    public function index($post)
    {
        $formatComments = array();
        $adminGroupID = Group::where('name', 'admin')->first()->id;
        
        foreach(BlogComment::where('blog_post_id', $post)->get() as $comment)
        {
            $formatComments[] =
            array 
            (
                'id' => (int)$comment->id,
                'blog_comment_parent_id' => $comment->blog_comment_parent_id ? (int)$comment->blog_comment_parent_id : null,
                'created_at' => '' . $comment->created_at,
                'updated_at' => '' . $comment->updated_at,
                'body_text' => $comment->body_text,
                'username' => $comment->user->username,
                'created_by_admin' => $comment->user->group_id == $adminGroupID,
                'created_by_current_user' => true
            ); 
        }
        
        return Response::make(json_encode($formatComments), 200, array('Content-Type' => 'application/json'));
    }	
    
    /**
     * Creates a new comment that is a child of the given post
     *
     * @param Request $request Request object that holds HTTP Request info
     * @param int $post Post ID
     * 
     * @return Response HTTP response with the new blog comment
     */
    public function store(Request $request, $post)
    {
        $comment = null;
        
        if($request->input('blog_comment_parent_id'))
        {
            $comment = BlogComment::create
            (
                [
                    'user_id' => 1,
                    'body_text' => $request->input('body_text'),
                    'blog_post_id' => (int)$post,
                    'blog_comment_parent_id' => (int)$request->input('blog_comment_parent_id')
                ]
            );
        }
        else
        {
            $comment = BlogComment::create
            (
                [
                    'user_id' => 1,
                    'body_text' => $request->input('body_text'),
                    'blog_post_id' => (int)$post
                ]
            );
        }
        
        return Response::make($comment->toJson(), 200, array('Content-Type' => 'application/json'));
    }
    
    /**
     * Updates a comment that is a child of the given post
     *
     * @param Request $request Request object that holds HTTP Request info
     * @param int $post Post ID
     * @param int $comment Comment ID
     * 
     * @return Response HTTP response with the updated blog comment
     */
    public function update(Request $request, $post, $comment)
    {
        $updatedComment = BlogComment::find($comment);

        $updatedComment->update
        (
            [
                'body_text' => $request->input('body_text')
            ]
        );
        
        return Response::make($updatedComment->toJson(), 200, array('Content-Type' => 'application/json'));
    }
    
    /**
     * Deletes a comment that is a child of the given post
     *
     * @param int $post Post ID
     * @param int $comment Comment ID
     * 
     * @return Response HTTP response with the deleted blog comment
     */
    public function destroy($post, $comment)
    {
        $deletedComment = BlogComment::find($comment);
        
        $deletedComment->delete();
        
        return Response::make($deletedComment->toJson(), 200, array('Content-Type' => 'application/json'));
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

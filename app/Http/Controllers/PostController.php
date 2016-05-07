<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\BlogPost;
use App\Models\BlogComment;

// ===============================================================================================================
// Post Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// 
// ===============================================================================================================

class PostController extends BaseController
{ 
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // ------------------------------------------------------------------------------------------------------------------------------
    // ATTRIBUTES
    // ------------------------------------------------------------------------------------------------------------------------------
	
    /**
     * Array of data to pass between controller and view
     *
     * @var array
     */
    protected $data = array();
	
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // ------------------------------------------------------------------------------------------------------------------------------
    // VIEW CREATORS 
    // ------------------------------------------------------------------------------------------------------------------------------
	
    /**
     * Creates home page view for end-user.
     *
     * @return View Blog home page
     */
    public function index()
    {
        // Get basic information for home page
        $this->data['title'] = "The Blog";
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        
        // Get all blog posts
        $this->data['posts'] = BlogPost::orderBy('created_at', 'desc')->paginate(3);
        
        // Display notifications (if there are any)
        BaseController::processNotifications();
        
        return view('blog.home', $this->data);
    }	
    
    /**
     * Creates management view for
     *
     * @return View Blog home page
     */
    public function manage()
    {
        // Get basic information for home page
        $this->data['title'] = "Manage Blog Posts";
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        
        // Get all blog posts
        $this->data['posts'] = BlogPost::orderBy('created_at', 'desc')->paginate(15);
        
        // Display notifications (if there are any)
        BaseController::processNotifications();
        
        return view('blog.admin.post_manager', $this->data);
    }	
    
   /**
     * Creates a post editor view for the end-user
     *
     * @return View Blog post editor page
     */
    public function create()
    {
        // Get basic information for home page
        $this->data['title'] = "Create a Blog Post - The Blog";
        $this->data['showNotifications'] = false;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;

        return view('blog.admin.post_editor', $this->data);
    }
    
    /**
     * Shows a blog page with its comments for end-user.
     * 
     * @param int $post Post ID
     *
     * @return View Blog page
     */
    public function show($post)
    {
        // Get blog post
        $blogPost = BlogPost::find($post);
        $this->data['post'] = $blogPost;
        
        // Get basic information for home page
        $this->data['title'] = $blogPost->title_text . ' - The Blog';
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        
        // Display notifications (if there are any)
        BaseController::processNotifications();
        
        return view('blog.blog', $this->data);
    }
    
    /**
     * Shows a post editor with the given post information for the end-user
     *
     * @param int $post Post ID
     * 
     * @return View Blog post editor page
     */
    public function edit($post)
    {
        // Get blog post
        $blogPost = BlogPost::find($post);
        $this->data['post'] = $blogPost;
        
        // Get basic information for home page
        $this->data['title'] = 'Editing ' . $blogPost->title_text . ' - The Blog';
        $this->data['showNotifications'] = false;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        
        return view('blog.admin.post_editor', $this->data);
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------
    // DATA MODIFIERS
    // ------------------------------------------------------------------------------------------------------------------------------
    
    /**
     * Creates a new blog post
     * 
     * @param Request $request Request object that holds HTTP Request info
     * @param int $post Post ID
     * 
     */
    public function store(Request $request)
    {
        // Get currently logged in user
        $user = \Sentinel::check();

        $rules =
        [
            'title' => 'required',
            'body_text' => 'required'
        ];

        // Check rules
        $validator = \Validator::make($request->all(), $rules);
        
        if($validator->fails())
        {
            return redirect()->route('blog::post.create')->withInput($request->all())->withErrors($validator);
        }

        $post = BlogPost::create
        (
            [
               'user_id' => (int)$user->id,
               'title_text' => $request->input('title'),
               'body_text' => $request->input('body_text')
            ]
        );


        BaseController::addNotification('Blog successfully created.', 'success');


        return redirect()->route('blog::post.manage');
    }
    
    /**
     * Updates a pre-existing blog post
     * 
     * @param Request $request Request object that holds HTTP Request info
     * @param int $post Post ID
     * 
     */
    public function update(Request $request, $post)
    {
        // Get post to update
        $updatedPost = BlogPost::find($post);

        $rules =
        [
            'title' => 'required',
            'body_text' => 'required'
        ];

        // Check rules
        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->route('blog::post.edit', ['post' => $post])->withInput($request->all())->withErrors($validator);
        }

        $updatedPost->update
        (
            [
                'title_text' => $request->input('title'),
                'body_text' => $request->input('body_text')
            ]
        );

        BaseController::addNotification('Blog successfully updated', 'success');

        return redirect()->route('blog::post.manage');
        }

        /**
         * Deletes a pre-existing blog post
         *
         * @param int $post Post ID
         *
         */

        public function destroy($post)
        {
            //get post
            $deletedPost = BlogPost::find($post);
            
            // delete comments- need to turn off foreign key checks because of child comments
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $commentIDs = $deletedPost->comments->modelKeys();
            BlogComment::whereIn('id', $commentIDs)->delete(); 
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            // delete post
            $deletedPost->delete();
            
            BaseController::addNotification('Blog successfully deleted', 'success');
            
            return redirect()->route('blog::post.manage');
        }

    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

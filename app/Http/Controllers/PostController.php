<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\BlogPost;

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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // ------------------------------------------------------------------------------------------------------------------------------
    // ATTRIBUTES
    // ------------------------------------------------------------------------------------------------------------------------------
	
    protected $data = array();
	
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
    // ------------------------------------------------------------------------------------------------------------------------------
    // VIEW CREATORS 
    // ------------------------------------------------------------------------------------------------------------------------------
	
    /**
     * Creates home page view for end-user.
     *
     * @return View (blog home page)
     */
    public function index()
    {
        // Get basic information for home page
        $this->data['title'] = "Stellar Clicker: The Blog";
        $this->data['showDefaultNotifcations'] = true;
        $this->data['showNav'] = true;
        
        // Get all blog posts
        $this->data['posts'] = BlogPost::orderBy('created_at', 'desc')->paginate(3);

        return view('blog.home', $this->data);
    }	
    
    /**
     * 
     *
     * 
     */
    public function create()
    {
        
    }
    
    /**
     * Shows a blog page with its comments for end-user.
     *
     * @return View (blog page)
     */
    public function show($post)
    {
        // Get basic information for home page
        $this->data['title'] = "Stellar Clicker: The Blog";
        $this->data['showDefaultNotifcations'] = true;
        $this->data['showNav'] = true;
        
        // Get blog post
        $this->data['post'] = BlogPost::find($post);
        
        return view('blog.blog', $this->data);
        
    }
    
    /**
     * 
     *
     * 
     */
    public function edit($post)
    {
        
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------
    // DATA MODIFIERS
    // ------------------------------------------------------------------------------------------------------------------------------
    
    /**
     * 
     *
     * 
     */
    public function store()
    {
        
    }
    
    /**
     * 
     *
     * 
     */
    public function update($post)
    {
        
    }
    
    /**
     * 
     *
     * 
     */
    public function destroy($post)
    {
        
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

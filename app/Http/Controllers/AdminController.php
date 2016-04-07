<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// ===============================================================================================================
// Admin Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// 
// ===============================================================================================================

class AdminController extends BaseController
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
     * Creates the control panel view for the blogger or admin user
     *
     * @return View (home page)
     */
    public function controlPanel()
    {
        // Get basic information for home page
        $this->data['title'] = "SC Blog Control Panel";
        $this->data['showDefaultNotifcations'] = true;
        $this->data['showNav'] = true;
        
        // Get the currently logged in user

        return view('blog.control_panel', $this->data);
    }
    
    /**
     * Creates home page view for the blogger user
     *
     * @return View (home page)
     */
    public function createPost()
    {
        // Get basic information for home page
        $this->data['title'] = "Create SC Blog Post";
        $this->data['showDefaultNotifcations'] = true;
        $this->data['showNav'] = true;

        return view('blog.create_post', $this->data);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

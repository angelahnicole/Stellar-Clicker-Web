<?php

namespace App\Http\Controllers;

// ===============================================================================================================
// Home Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Controller for all of the different homepages for the website. (Except blog, as that has its own controllers)
// ===============================================================================================================
class HomeController extends BaseController
{ 
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
     * @return View (stellar home page)
     */
    public function index()
    {
        return stellarHome();
    }
	
    /**
     * Creates home page view for end-user.
     *
     * @return View (stellar home page)
     */
    public function stellarHome()
    {
        // Get basic information for home page
        $this->data['title'] = "Stellar Clicker: The Game";
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = false;
        
        return view('home.home', $this->data);
    }		
    
    /**
     * Creates home page view for end-user.
     *
     * @return View (wiki home page)
     */
    public function wikiHome()
    {
        // Get basic information for home page
        $this->data['title'] = "Stellar Clicker: The Wiki";
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = true;
        
        return view('wiki.home', $this->data);
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

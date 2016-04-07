<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

// ===============================================================================================================
// Home Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// Controller for the home page. Also handles logging in.
// ===============================================================================================================

class HomeController extends BaseController
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
     * @return View (home page)
     */
    public function index()
    {
        // Get basic information for home page
        $this->data['title'] = "Stellar Clicker: The Game";
        $this->data['showDefaultNotifcations'] = true;
        $this->data['showNav'] = false;

        return view('home.home', $this->data);
    }	
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

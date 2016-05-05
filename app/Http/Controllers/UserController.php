<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

// ===============================================================================================================
// User Controller
// ---------------------------------------------------------------------------------------------------------------
// Stellar Clicker
// https://github.com/angelahnicole/Stellar-Clicker-Web
// Angela Gross
// ---------------------------------------------------------------------------------------------------------------
// 
// ===============================================================================================================

class UserController extends BaseController
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
     * Creates a view that shows the login page
     *
     * @return View (login view)
     */
    public function login()
    {
        // Get basic information for home page
        $this->data['title'] = "Logging in";
        $this->data['showNotifications'] = false;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;

        return view('auth.login', $this->data);
    }
    
    /**
     * Logs user out of session 
     *
     * @return Redirect (blog home page)
     */
    public function logout()
    {
        \Sentinel::logout();

         BaseController::addNotification('You have successfully logged out.', 'success');

        return redirect()->route('blog::home');
    }	
    
    /**
     * Creates a view that manages all users
     *
     * @return View (user view)
     */
    public function manage()
    {
        // Get basic information for home page
        $this->data['title'] = "All Users";
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        
        // Get all users
        $this->data['users'] = User::orderBy('username', 'asc')->paginate(20);
        
        // Display notifications (if there are any)
        BaseController::processNotifications();

        return view('blog.admin.user_manager', $this->data);
    }
    
    /**
     * Creates a view that will allow a user (or an admin) to edit themselves
     *
     * @param int $user User ID
     *
     * @return View (login view)
     */
    public function edit($user)
    {
        // Get user
        $updateUser = User::find($user);
        $this->data['user'] = $updateUser;
        
        // Redirect if the user is invalid
        if(!$updateUser)
        {
            BaseController::addNotification("That user does not exist.", "error");
            return redirect()->route('blog::home');
        }
        
        // Get basic information for home page
        $this->data['title'] = "Editing " . $updateUser->username;
        $this->data['showNotifications'] = true;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        
        // Display notifications (if there are any)
        BaseController::processNotifications();

        return view('blog.admin.user', $this->data);
    }
    
    /**
     * Creates a view that will allow a user to request a password reset
     *
     * @return View (request password reset view)
     */
    public function createReset()
    {
        // Get basic information for home page
        $this->data['title'] = "Request Password Reset";
        $this->data['showNotifications'] = false;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;

        return view('auth.passwords.email', $this->data);
    }
    
    /**
     * Creates a view that will allow a user to execute a password reset
     *
     * @param int $id User ID
     * @param string $code Password Reset token
     * 
     * @return View (password reset view)
     */
    public function editPassword($id, $code)
    {
        // Get basic information for home page
        $this->data['title'] = " Password Reset";
        $this->data['showNotifications'] = false;
        $this->data['showNav'] = true;
        $this->data['showLogin'] = true;
        $this->data['id'] = $id;
        $this->data['token'] = $code;

        return view('auth.passwords.reset', $this->data);
    }
    
    // ------------------------------------------------------------------------------------------------------------------------------
    // DATA MODIFIERS
    // ------------------------------------------------------------------------------------------------------------------------------
    
    /**
     * Creates a new user
     *
     * @param Request $request Request object that holds HTTP Request info
     * 
     * @return View (either the login view if there are errors or the blog home if there aren't)
     */
    public function store(Request $request)
    {
       // Form rules
        $rules =
        [
            'reg-username' => 'required|unique:users,username',
            'reg-email' => 'required|email|unique:users,email',
            'reg-password' => 'required|confirmed',
        ];
        
        // New user credentials
        $credentials = 
        [
            'username' => $request->has('reg-username') ? $request->input('reg-username') : null,
            'email'    => $request->has('reg-email') ? $request->input('reg-email') : null,
            'password' => $request->has('reg-password') ? $request->input('reg-password') : null
        ];

        // Check rules
        $validator = \Validator::make($request->all(), $rules);
        
        // Register user
        $authenticate = $this->validateCreation($credentials);

        // Try again if failed
        if($validator->fails() || $authenticate['error'])
        {
            $errorMessages = $validator->errors();

            if($authenticate['error'])
            {
                $errorMessages->add('sentinel_register', $authenticate['error']);
            }

            return redirect()->route('blog::user.login')->withInput($request->except('reg-password', 'reg-password_confirmation'))->withErrors($validator);
        }
        
        BaseController::addNotification("You have successfully registered.", "success");
        
        return redirect()->route('blog::home');
    }
    
    /**
     * Updates a pre-existing user
     *
     * @param Request $request Request object that holds HTTP Request info
     * @param int $user User ID
     * 
     * @return View (either the user edit view if there are errors or the blog home if there aren't)
     */
    public function update(Request $request, $user)
    {
        // this will be very similar to store
        // Get post to update
            $updateUser = User::find($user);

            $rules =
            [
                'username' => 'required|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed'


            ];

            // Check rules
            $validator = \Validator::make($request->all(), $rules);

            if($validator->fails())
            {
                return redirect()->route('blog::user.edit')->withInput($request->all())->withErrors($validator);
            }

            $updatePost->update
            (
                [
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password'),
                    
                ]
            );

            BaseController::addNotification('User successfully updated', 'success');

            return redirect()->route('blog::home');
    }
    
    /**
     * Destroy a pre-existing user
     *
     * @param Request $request Request object that holds HTTP Request info
     * @param int $user User ID
     * 
     * @return View (either the user edit view if there are errors or the blog home if there aren't)
     */
    public function destroy(Request $request, $user)
    {
        //get 
       $updateUser = User::find($user);


       $updateUser->delete();
       BaseController::addNotification('User successfully deleted', 'success');
       return redirect()->route('blog::home');
    }
    
    /**
     * Takes in a user's email address and sends them an email to reset their password
     *
     * @param Request $request Request object that holds HTTP Request info
     * 
     * @return View (either the create reset view if there are errors or the blog home if there aren't)
     */
    public function storeReset(Request $request)
    {
        // Form rules
        $rules =
        [
            'email' => 'required|email'
        ];
        
        // New user credentials
        $credentials = 
        [
            'email'    => $request->has('email') ? $request->input('email') : null,
        ];

        // Check rules
        $validator = \Validator::make($request->all(), $rules);

        // Try again if failed
        if($validator->fails())
        {
            return redirect()->route('blog::user.createReset')->withInput($request->all())->withErrors($validator);
        }
        else 
        {
            // Try to find user
            $user = \Sentinel::findByCredentials($credentials);

            if($user)
            {

                $reminder = \Reminder::exists($user) ? \Reminder::exists($user) : \Reminder::create($user);
                $this->emailPWReset($user, $reminder);
                
                BaseController::addNotification("An email has been sent to the email address provided with instructions on how to reset your password.", "success");
            }
            else
            {
                BaseController::addNotification("An email could not be sent to the email address provided.", "error");
            }

            return redirect()->route('blog::home');
        }
        
    }
    
    /**
     * Takes in a user's email address + password and updates their password, given the reset token
     * and user ID.
     *
     * @param Request $request Request object that holds HTTP Request info
     * @param int $id User ID
     * @param string $code Password Reset token
     * 
     * @return View (either the create reset view if there are errors or the blog home if there aren't)
     */
    public function updatePassword(Request $request, $id, $code)
    {
        // Form rules
        $rules =
        [
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
        
        // New user credentials
        $credentials = 
        [
            'email'    => $request->has('email') ? $request->input('email') : null,
            'password' => $request->has('password') ? $request->input('password') : null
        ];

        // Check rules
        $validator = \Validator::make($request->all(), $rules);
        
        // Try again if failed
        if($validator->fails())
        {
            return redirect()->route('blog::user.editPassword', ['id' => $id, 'token' => $code])->withInput($request->except('password', 'password_confirmation'))->withErrors($validator);
        }
        
        // Reset password
        $user = \Sentinel::findByCredentials($credentials);
        $reminder = \Reminder::exists($user, $code);
        
        // Redirect user if the information given is incorrect
        if($reminder)
        {
            \Reminder::complete($user, $code, $credentials['password']);
        }
        else
        {
            BaseController::addNotification("We're unable to reset your password with the given information. Please try again.", "error");
        }
        
        BaseController::addNotification("You have successfully reset your password. Please log in again.", "success");
        
        return redirect()->route('blog::home');
    }
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // ------------------------------------------------------------------------------------------------------------------------------
    // HELPER FUNCTIONS
    // ------------------------------------------------------------------------------------------------------------------------------
    
    /**
     * Takes in a user's email address + password and tries to log them in.
     *
     * @param Request $request Request object that holds HTTP Request info
     * 
     * @return View (either the user login view if there are errors or the blog home if there aren't)
     */
    public function validateLogin(Request $request)
    {
        // Get RememberMe check
        $rememberMe = $request->input('login-remember');
        
       // Form rules
        $rules =
        [
            'login-email' => 'required|email',
            'login-password' => 'required',
        ];
        
        
        $credentials = 
        [
            'email'    => $request->has('login-email') ? $request->input('login-email') : null,
            'password' => $request->has('login-password') ? $request->input('login-password') : null
        ];

        // Check rules
        $validator = \Validator::make($request->all(), $rules);
        
        // Log in user
        $authenticate = $this->authenticateUser($credentials, $rememberMe);

        // Try again if failed
        if($validator->fails() || $authenticate['error'])
        {
            $errorMessages = $validator->errors();

            if($authenticate['error'])
            {
                $errorMessages->add('sentinel_login', $authenticate['error']);
            }

            return redirect()->route('blog::user.login')->withInput($request->except('login-password'))->withErrors($validator);
        }
        
        self::addNotification('You have successfully logged in.', 'success');
        
        return redirect()->route('blog::home');
    }
    	
    /**
     * Authenticates user credentials using Sentinel.
     * 
     * @param array() $credentials An array with email and password
     * @param bool $rememberMe Whether or not to remember the user
     *
     * @return array() User info and errors (if any)
     */
    private function authenticateUser($credentials, $rememberMe)
    {
        $authenticate = array
        (
            'user' => null,
            'error' => null
        );

        // Log in user 
        try
        {
            $authenticate['user'] = \Sentinel::authenticate($credentials, $rememberMe);
            
            if(!\Sentinel::findByCredentials($credentials))
            {
                $authenticate['error'] = 'That user does not exist.';
            }
        }
        catch (\Exception $e)
        {
            $authenticate['error'] = $e->getMessage();
        }

        return $authenticate;
    }
    
    /**
     * Creates a new user
     * 
     * @param array() $credentials An array with email and password
     *
     * @return array() User info and errors (if any)
     */
    private function validateCreation($credentials)
    {
        $authenticate = array
        (
            'user' => null,
            'error' => null
        );

        // Log in user 
        try
        {
            if(\Sentinel::validForCreation($credentials))
            {
                $authenticate['user'] = \Sentinel::create($credentials);
            }
        }
        catch (\Exception $e)
        {
            $authenticate['error'] = $e->getMessage();
        }

        return $authenticate;
    }
    
    /**
     * Emails the user a URL with a token to reset their password.
     *
     * @param int $id User ID
     * @param Reminder $reminder Sentinel Reminder object
     */
    private function emailPWReset($user, $reminder)
    {
        $data = 
        [
            'email' => $user->email,
            'name' => $user->username,
            'subject' => 'Reset Your Password',
            'code' => $reminder->code,
            'id' => $user->id
        ];

        \Mail::send('auth.emails.password', $data, function($message) use ($data) 
        {
            $message->to($data['email'], $data['name'])->subject($data['subject']);
        });
    }
	
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

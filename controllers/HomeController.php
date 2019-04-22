<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function index()
	{
		return View::make('index');
	}

	public function login()
	{
        $email=Input::get('email');
        $password=Input::get('password');
        $email=addslashes($email);
        $password=addslashes($password);
    //    $password=md5($password);


        $validator = Validator::make(array('email'=>$email,'password'=>$password),
        array(
            'email' => 'required|between:3,255',
            'password' => 'required|between:3,255|alpha_num|exists:users,password,email,'.$email),
        array(
            'required' => 'Niste popunili polje/a!',
            'between' => 'Broj karaktera mora biti izme&#273;u 3 i 20!',
            'alpha_num' => 'Polje sme sadr&#382;ati samo slova i cifre!',
            'exists' => 'Uneli ste pogre&scaron;no korisni&#269;ko ime ili lozinku!',
        ));

        if($validator->fails()){
            return Redirect::to(Links::base_url())->withInput()->withErrors($validator->messages());
        }else{
        	$user = Users::where('email', Input::get('email'))->first();
        	Session::put('user_id', base64_encode($user->users_id));      	
			return Redirect::to(Links::base_url());
		}

	}

	public function logout(){
		Session::forget('user_id');
		return Redirect::to(Links::base_url());
	}
}



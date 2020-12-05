<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $loggedInUserRole=$request->user()->roles[0]->slug_name;
        $redirectionURL=config('constants.Homepage.'. $loggedInUserRole);
        if(!empty($redirectionURL) && $redirectionURL!='/home'){
            return redirect()->to($redirectionURL);
        }
        return view('home');
    }
}

<?php

namespace App\Http\Controllers;


use App\log;
use App\User;
use ClassPreloader\Config;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Companies;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DomainChecker extends Controller
{
    function __construct(){
        $this->log = new log();
    }

    /**
     * Display Sub-Domain checker page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('domain');
    }

    /**
     * Check if a Sub-Domain Exists.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return view()
     */
    public function domainChecker(Request $request)
    {
        $data = Companies::where('subdomain','=',$request->domain)->where('status','=',1)->first();
        if($data){
            session(['company' => $data]);  // Setting the session value to be used in middleware
            return view('user.userlogin',['data' => $data->db_name ]);
        } else {
            return redirect()->route('domain');
        }
    }

    /**
     * Display company user login page
     *
     * @return \Illuminate\View\View
     */
    public function companyUserLogin()
    {
        return view('user.userlogin');
    }

    /**
     * Login Company User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function postCompanyLogin(Request $request)
    {
        try{
            Auth::logout(); // Logout any loged in user
            $conn = self::configureConnectionByName($request->domain);  // Change main database to company's database
            $authenticate = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if ($authenticate) {
                return redirect()->route('companyHome');
            } else {
                session(['company' => null]);   // Set session value to null if Authentication fails
                return redirect()->route('domain');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Display Company Home Page
     *
     * @return \Illuminate\View\View
     */
    public function companyHome()
    {
        if(Auth::user()){
            $logs = $this->log->getAllLogs();   // Get all log of company
            return view('landing')->with('logs', $logs);
        } else {
            return redirect()->route('domain');
        }
    }

    /**
     * Set main Database name to Company Database
     *
     * @param  string $tenantName
     * @return \Config
     */
    public function configureConnectionByName($tenantName){
        $config = App::make('config');
        $config->set('database.connections.mysql.database', $tenantName);
        return $config->get('database.connections');
    }

}
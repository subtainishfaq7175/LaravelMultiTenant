<?php

namespace App\Http\Controllers;


use App\log;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Companies;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DomainChecker extends Controller
{
    function __construct(){
        $this->log = new log();
    }

    public function index()
    {
        return view('domain');
    }

    public function domainChecker(Request $request)
    {
        $data = Companies::where('subdomain','=',$request->domain)->where('status','=',1)->first();
        if($data){
            session(['company' => $data]);
            return view('user.userlogin',['data' => $data->db_name ]);
        } else {
            return redirect()->route('domain');
        }
    }

    public function companyUserLogin()
    {
        return view('user.userlogin');
    }

    public function postCompanyLogin(Request $request)
    {
        try{
            Auth::logout();
            $conn = self::configureConnectionByName($request->domain);
            $authenticate = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
            if ($authenticate) {
                return redirect()->route('companyHome');
            } else {
                session(['company' => null]);
                return redirect()->route('domain');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    public function companyHome(Request $request)
    {
        if(Auth::user()){
            $logs = $this->log->getAllLogs();
            return view('landing')->with('logs', $logs);
        } else {
            return redirect()->route('domain');
        }
    }

    public function configureConnectionByName($tenantName){
        $config = App::make('config');
        $config->set('database.connections.mysql.database', $tenantName);
        return $config->get('database.connections');
    }

}
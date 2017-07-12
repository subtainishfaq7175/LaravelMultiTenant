<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use App\Companies;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DomainChecker extends Controller
{
    //
    public function index()
    {
        //
        return view('domain');
    }

    public function domainChecker(Request $request)
    {
        $data = Companies::where('subdomain','=',$request->domain)->where('status','=',1)->first()['db_name'];
        if($data){
            return view('user.userlogin',['data' => $data ]);
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
        $validate_admin = DB::table($request->domain.'.users')
            ->where('email', $request->email)
            ->where('password',md5($request->password))
            ->first();
        if ($validate_admin) {
            // here you know data is valid
            $data = $request->session()->put('login', $validate_admin);
            return redirect()->route('companyHome');
        } else {
            return redirect()->route('domain');
        }
        
    }

    public function companyHome(Request $request)
    {
        if(Session::has('login')){
            return view('landing');
        } else {
            return redirect()->route('domain');
        }

    }

}

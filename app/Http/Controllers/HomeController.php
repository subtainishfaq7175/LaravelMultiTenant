<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Companies::all();
        try {
            foreach ($companies as $company){
                $company->usercount = count(DB::table($company->db_name.'.users')->get());
            }
        } catch (\Exception $e) {}
        return view('home', ['data' => $companies]);
    }
}

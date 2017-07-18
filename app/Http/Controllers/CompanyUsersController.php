<?php

namespace App\Http\Controllers;

use App\Companies;
use App\log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyUsersController extends Controller
{
    function __construct(){
        $this->log = new log();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function store(Request $request)
    {
        $data = array(
            'username' => $request->name,
            'role' => $request->role,
            'status' => $request->status,
            'email' => $request->email,
            'password' => bcrypt($request->password_confirmation)
        );
        $table = $request->domain.'.users';
        DB::table($table)->insert($data);
        return redirect()->route('home');
    }

    /**
     * Delete a company user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function companyUserDelete(Request $request)
    {
        $data = explode('-',$request->company_user_id);
        $company_id = $data[0];
        $user_id = $data[1];
        $companyInfo = Companies::find($company_id);
        $database = $companyInfo->db_name;
        $deleteUserFromCompany = "DELETE FROM ".$database.".users WHERE id = ".$user_id;
        DB::statement($deleteUserFromCompany);
        return $deleteUserFromCompany;
    }

    /**
     * Save a log for Company User
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function saveLog(Request $request){
        $log = $this->log->saveLog($request);
        return redirect()->back();
    }
}

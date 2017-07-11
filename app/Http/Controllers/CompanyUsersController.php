<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyUsersController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        $data = array(
            'username' => $request->name,
            'role' => $request->role,
            'status' => $request->status
        );
        $table = $request->domain.'.users';
        DB::table($table)->insert($data);
        return redirect()->route('home');

    }

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
}

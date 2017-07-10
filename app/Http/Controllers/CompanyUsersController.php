<?php

namespace App\Http\Controllers;

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
}

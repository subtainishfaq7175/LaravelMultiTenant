<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('company.company');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $companyObj = new Companies();
            $companyObj->name = $request->name;
            $companyObj->subdomain = $request->subdomain;
            $db_name = str_replace(".","_",$request->subdomain);
            $companyObj->db_name = $db_name;
            $companyObj->status = $request->status;
            $companyObj->save();
            //

            DB::statement('CREATE DATABASE '.$db_name);
            $mysqlTable = "CREATE TABLE ".$db_name.".users 
            (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(30) NOT NULL,
            role VARCHAR(30) ,
            status VARCHAR(50),
            email VARCHAR(50),
            password VARCHAR(50),
            reg_date TIMESTAMP)";
            DB::statement($mysqlTable);
            return redirect()->route('home');

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $companyInfo = Companies::find($id);
        $users = DB::table($companyInfo->db_name.'.users')->get();
        return view('company.detail',['data' => $companyInfo,'users' => $users ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $companyInfo = Companies::find($id);
        return view('company.edit',['data' => $companyInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $companyInfo = Companies::find($request->id);
        $companyInfo->name = $request->name;
        $companyInfo->subdomain = $request->subdomain;
        $companyInfo->status = $request->status;
        $companyInfo->Save();
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setDBConnection()
    {
        Config::set('database.connections.dynamicConnection.database', 'fine_vbase_com');
        Config::set('database.default', 'dynamicConnection');
        DB::purge('dynamicConnection');
        DB::reconnect('dynamicConnection');
        return DB::connection('dynamicConnection');

    }


    public function adduser($id)
    {
        //
        $companyInfo = Companies::find($id);
        return view('user.user',['data' => $companyInfo]);
    }

    public function companyDelete(Request $request)
    {
        $delete = Companies::find($request->company_id);
        return $delete->delete();

    }
}

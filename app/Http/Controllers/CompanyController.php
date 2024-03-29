<?php

namespace App\Http\Controllers;

use App\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('company.company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function store(Request $request)
    {
        try {
            $companyObj = new Companies();
            $companyObj->name = $request->name;
            $companyObj->subdomain = self::clean($request->subdomain);  // Removing user provided sub-domain name from all special characters and replacing them with .
            $db_name = str_replace(".","_",$request->subdomain);
            $companyObj->db_name = $db_name;
            $companyObj->status = $request->status;
            $companyObj->save();

            DB::statement('CREATE DATABASE '.$db_name); // Creating new Database
            $res = self::configureConnectionByName($db_name); // Changing connection from main database to newly created database
            $artisan = \Artisan::call('migrate', array('--database' => $db_name, '--env' => 'local', '--path' => 'database/tenants')); // Calling php artisan migrate command to create new tables in company database
            return redirect()->route('home');
        } catch (\Exception $e) {
            dd($e);
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $companyInfo = Companies::find($id);
        $users = DB::table($companyInfo->db_name.'.users')->get();
        return view('company.detail',['data' => $companyInfo,'users' => $users ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $companyInfo = Companies::find($id);
        return view('company.edit',['data' => $companyInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function update(Request $request)
    {
        $companyInfo = Companies::find($request->id);
        $companyInfo->name = $request->name;
        $companyInfo->subdomain = $request->subdomain;
        $companyInfo->status = $request->status;
        $companyInfo->Save();
        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function adduser($id)
    {
        $companyInfo = Companies::find($id);
        return view('user.user',['data' => $companyInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Database\Eloquent\SoftDeletes
     */
    public function companyDelete(Request $request)
    {
        $delete = Companies::find($request->company_id);
        return $delete->delete();
    }

    /**
     * Configures a tenant's database connection.

     * @param  string $tenantName The database name.
     * @return void
     */
    public function configureConnectionByName($tenantName){
        // Just get access to the config.
        $config = App::make('config');

        // Will contain the array of connections that appear in our database config file.
        $connections = $config->get('database.connections');

        // This line pulls out the default connection by key (by default it's `mysql`)
        $defaultConnection = $connections[$config->get('database.default')];

        // Now we simply copy the default connection information to our new connection.
        $newConnection = $defaultConnection;
        // Override the database name.
        $newConnection['database'] = $tenantName;

        // This will add our new connection to the run-time configuration for the duration of the request.
        App::make('config')->set('database.connections.'.$tenantName, $newConnection);
    }

    /**
     * Clean a string from all special characters and replace them with .
     *
     * @param  string $string
     * @return string
     */
    public function clean($string) {
        $string = str_replace(' ', '.', $string);
        $string = preg_replace('/[^A-Za-z0-9\-ığşçöüÖÇŞİıĞ]/', '.', $string);
        return preg_replace('/-+/', '.', $string);
    }
}

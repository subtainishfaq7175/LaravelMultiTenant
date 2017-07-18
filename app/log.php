<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class log extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'log',
        'user_id'
    ];

    protected $table = "logs";

    public function saveLog($request){
        $array = [
            'log' => $request->log ? $request->log : '',
            'user_id' => Auth::user()->id ? Auth::user()->id : '',
        ];
        $result = $this->create($array);
        return $result;
    }

    public function users(){
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getAllLogs(){
        return $this
                ->with('users')
                ->get();
    }

}

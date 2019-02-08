<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','employee_uid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot',
    ];

    protected $appends = ['uid', 'position'];
    

    protected static function boot(){
        parent::boot();

        static::creating(function ($query) {
            $query->api_token = str_random(61);
        });
    }

    public static function getPossibleRoles(){
        $type = DB::select( DB::raw("SHOW COLUMNS FROM users WHERE Field = 'role'") )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = [];
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            array_push($enum, $v);
        }
        return $enum;
    }

    public function getUidAttribute(){
        if(isset($this->pivot)){
            return $this['attribute'] = $this->pivot->employee_uid;
        }
    }
    public function getPositionAttribute(){
        if(isset($this->pivot)){
            return $this['attribute'] = $this->pivot->position;
        }
    }

    public function centerAssignment(){
        return $this->belongsToMany('App\System\Center','center_employees','employee_id','center_id');
    }

}

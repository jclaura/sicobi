<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

use App\Models\Empleado;  

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol',
    ];

    //RELACION DE UNO A UNO
    public function empleado(){
        return $this->belongsTo('App\Models\Empleado');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image(){
        $userId = auth()->user()->id;        
        $empleado = Empleado::where('user_id', '=',$userId )->get()->first();         
        $avatar = asset('/storage/FotosUsuarios/'.$empleado->avatar);        
        return $avatar;
    }

    public function adminlte_profile_url(){
        return 'profile/username';
    } 

    public function adminlte_desc(){        
        return auth()->user()->rol;       
    }   
}

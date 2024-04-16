<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class UserCaminante extends Authenticatable implements Authenticatable
{
    //

    protected $table = 'user_caminantes';
    
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
}

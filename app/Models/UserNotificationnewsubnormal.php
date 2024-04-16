<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationnewsubnormal extends Model
{
    //

    protected $table = 'user_notificanewsubnormal';
    protected $fillable = [
        'user_id',
        'notinewsubnormal_id',
    ];

    public function notifications()
    {
        return $this->belongsToMany(CrearSubnormal::class, 'user_notificanewsubnormal')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notificanewsubnormal')->withTimestamps();
    }
}

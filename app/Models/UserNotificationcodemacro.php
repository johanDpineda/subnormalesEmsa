<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationcodemacro extends Model
{
    //
    protected $table = 'user_notificationcodemacro';
    protected $fillable = [
        'user_id',
        'notificationcodemacro_id',
    ];

    public function notifications()
    {
        return $this->belongsToMany(Controlterreno::class, 'user_notificationcodemacro')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notificationcodemacro')->withTimestamps();
    }
}

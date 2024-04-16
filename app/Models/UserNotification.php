<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    //

    protected $table = 'user_notification';
    protected $fillable = [
        'user_id',
        'notification_id',
    ];

    public function notifications()
    {
        return $this->belongsToMany(Datoscaminante::class, 'user_notification')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notification')->withTimestamps();
    }
}

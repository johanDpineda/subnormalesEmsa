<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationdocuments extends Model
{
    //
    protected $table = 'user_notificantiondocuments';
    protected $fillable = [
        'user_id',
        'notificationdocuments_id',
    ];

    public function notifications()
    {
        return $this->belongsToMany(DocumentsAcuerdoemsa::class, 'user_notificantiondocuments')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notificantiondocuments')->withTimestamps();
    }
}

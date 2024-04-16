<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotificationcodefactura extends Model
{
    //

    protected $table = 'user_notificationcodefactura';
    protected $fillable = [
        'user_id',
        'notificationcodefactura_id',
    ];

    public function notifications()
    {
        return $this->belongsToMany(Invoicecode::class, 'notificationcodefactura_id')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'notificationcodefactura_id')->withTimestamps();
    }
}

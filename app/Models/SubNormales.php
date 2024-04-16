<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubNormales extends Model
{
    //

    protected $table = 'Staff_user';
    protected $fillable = ['name','is_active'];

    public static function boot()
    {
        parent::boot();

        self::saving(function ($Staff) {
            $Staff->slug = Str::slug($Staff->name, '-');
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function datoscaminante(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Datoscaminante::class);
    }
}

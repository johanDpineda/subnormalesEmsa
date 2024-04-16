<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employees extends Model
{
    //

    protected $table = 'employees_user';

    protected $fillable = ['name', 'lastname', 'dni', 'phone'];

    
    public static function boot()
    {
        parent::boot();

        self::saving(function ($Employees) {
            $Employees->slug = Str::slug($Employees->full_name, '-');
        });
    }

    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->lastname}";
    }

    public function store()
    {
        return $this->hasOne(SubNormales::class);

    }
}

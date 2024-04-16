<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Codesiecsubnormales extends Model
{
    //
    protected $table = 'codigosiec_censo';

    protected $fillable = [
        'codigo_siec','censo_id'
    ];


    public function codesiecsdd()
    {
        return $this->hasOne(Censo::class, 'censo_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Censo extends Model
{
    //

    protected $table = 'censo';

    public function Datoszonas(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CrearSubnormal::class,'zona_subnormal_id');
    }


    public function Datosmunicipios(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(municipalities::class,'municipalities_id');
    }


    public function doccensofamily()
    {
        return $this->hasOne(Documentocenso::class, 'censo_id');
    }

    public function codesiecs()
    {
        return $this->hasOne(Codesiecsubnormales::class, 'censo_id');
    }

    public function controlTerrenos()
    {
        return $this->belongsTo(Controlterreno::class, 'zona_subnormal_id', 'zona_subnormal_id');
    }

}

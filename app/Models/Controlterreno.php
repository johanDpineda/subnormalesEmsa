<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Controlterreno extends Model
{
    //
    protected $table = 'control_terrenos';

    public function Datoscaminante(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Datoscaminante::class,'data_caminante_id');
    }

}

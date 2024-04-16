<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentsalcaldias extends Model
{
    //
    protected $table = 'certificado_alcaldia';

    protected $fillable = [
        'file_name_alcaldia','zona_subnormal_id','start_date'
    ];


    public function newdocumentoalcaldia(){
        return $this->belongsTo(CrearSubnormal::class,'zona_subnormal_id');
    }
}

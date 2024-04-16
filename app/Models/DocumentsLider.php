<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentsLider extends Model
{
    //

    protected $table = 'acta_representante';

    protected $fillable = [
        'file_name_actalider','zona_subnormal_id','start_date'
    ];


    public function newdocumentolider(){
        return $this->belongsTo(CrearSubnormal::class);
    }
}

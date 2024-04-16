<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentsAcuerdoemsa extends Model
{
    //
    protected $table = 'acta_emsa';

    protected $fillable = [
        'file_name_acuerdoemsa','zona_subnormal_id','start_date'
    ];


    public function newdocumentoacuerdoemsa(){
        return $this->belongsTo(CrearSubnormal::class,'zona_subnormal_id');
    }
}

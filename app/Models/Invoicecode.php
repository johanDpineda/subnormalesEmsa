<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoicecode extends Model
{
    //

    protected $table = 'acta_codetesoreria';

    protected $fillable = [
        'invoice_code','zona_subnormal_id'
    ];


    public function zonassubnormales(){
        return $this->belongsTo(CrearSubnormal::class,'zona_subnormal_id');
    }
}

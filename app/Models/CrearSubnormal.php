<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CrearSubnormal extends Model
{
    //
    protected $table = 'zona_subnormal';

    protected $fillable = [
        'file_name_alcaldia',  'file_name_actalider',   'file_name_acuerdoemsa'
    ];


    public function controlterreno(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(controlterreno::class,'control_terrenos_id');
    }

    public function municipality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(municipalities::class,'municipios_zone_id');
    }

    public function docalcaldia()
    {
        return $this->hasOne(Documentsalcaldias::class, 'zona_subnormal_id');
    }

    public function doclider()
    {
        return $this->hasOne(DocumentsLider::class, 'zona_subnormal_id');
    }


    public function docacuerdoemsa()
    {
        return $this->hasOne(DocumentsAcuerdoemsa::class, 'zona_subnormal_id');
    }

    public function codefactura()
    {
        return $this->hasOne(Invoicecode::class, 'zona_subnormal_id');
    }






}


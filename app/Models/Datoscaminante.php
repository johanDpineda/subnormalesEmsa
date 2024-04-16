<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Datoscaminante extends Model
{
    //

    protected $table = 'data_caminante';
    protected $fillable = ['name', 'latitude', 'longitude', 'Cantidad_transformador', 'Cantidad_usuario', 'Observaciones', 'network_status_id'];



    public function networkstatus(){
        return $this->belongsTo(NetworkStatus::class,'network_status_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'role_id');
    }

    

}

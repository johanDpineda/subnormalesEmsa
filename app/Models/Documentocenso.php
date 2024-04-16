<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentocenso extends Model
{
    //

     //
     protected $table = 'documento_censo';

     protected $fillable = [
         'file_name_censo','censo_id'
     ];


     public function newdocumentolider(){
        return $this->belongsTo(Censo::class);
    }

}

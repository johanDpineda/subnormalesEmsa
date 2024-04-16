<?php

namespace App\Mail;

use App\Models\CrearSubnormal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacioncodeTesoreria extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Notificación de Generación de codigo para la factura en un sector Subnormal';
    public $data;
    public $terreno;
    public $datoszonasubnormal;
    public $datomacromedidos;
    public $datoszonasubnormalcode;

    public $existingRecord;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($existingRecord)
    {
        //
        $this->existingRecord = $existingRecord;
        //$this->terreno = Controlterreno::findOrFail($data['data_caminante_id']);
        $this->terreno = CrearSubnormal::with('controlterreno')->findOrFail($existingRecord['control_terrenos_id']);


        $this->datoszonasubnormal=$this->terreno->controlterreno;

         $this->datoszonasubnormalcode = $this->terreno->controlterreno;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $existingRecord = [
            'existingRecord' => $this->existingRecord,

        ];

        return $this->view('emails.NotificacionTesoreria', $existingRecord);
    }
}

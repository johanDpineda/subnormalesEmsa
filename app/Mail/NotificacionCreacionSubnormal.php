<?php

namespace App\Mail;

use App\Models\CrearSubnormal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionCreacionSubnormal extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = 'Notificación de Generación de zona subnormal';
    public $data;
    public $terreno;
    public $datoszonasubnormal;
    public $datomacromedidos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //

        $this->data = $data;
        //$this->terreno = Controlterreno::findOrFail($data['data_caminante_id']);
        $this->terreno = CrearSubnormal::with('controlterreno')->findOrFail($data['control_terrenos_id']);


        $this->datomacromedidos=$this->terreno->controlterreno;
        
         $this->datoszonasubnormal = $this->terreno->controlterreno->Datoscaminante;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'data' => $this->data,

        ];

        return $this->view('emails.NotificacionCreacionSubnormal', $data);
    }
}
